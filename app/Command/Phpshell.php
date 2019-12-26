<?php

namespace App\Command;

use Illuminate\Support\Facades\Session;

class Phpshell {
  function command($req){
    $command = isset($req->command) ? $req->command : '';
    try {

    /* Clicked on one of the subdirectory links - ignore the command */
      if (isset($req->levelup)) {
          $levelup = $req->levelup ;
          while ($levelup > 0) {
              $command = '' ; /* ignore the command */
              Session::put('cwd',dirname(Session::get('cwd')));
              $levelup -- ;
          }
      }
      //command
      if (!empty($command)) {
        $output = collect(Session::get('output'));
        $history = collect(Session::get('history'));
        $history->push($command);
        Session::put('history', $history->toArray());

        /* Now append the command to the output. */
        $output->push(htmlspecialchars(Session::get('ini')['settings']['PS1'] . $command, ENT_COMPAT, 'UTF-8') . "\n");

        if (trim($command) == 'cd') {
            Session::put('cwd', realpath($this->ini['settings']['home-directory']));
        }elseif (preg_match('/^[[:blank:]]*cd[[:blank:]]+([^;]+)$/', $command, $regs)) {
            /* The current command is a 'cd' command which we have to handle
             * as an internal shell command. */

            /* if the directory starts and ends with quotes ("), remove them -
               allows command like 'cd "abc def"' */
            if ((substr($regs[1], 0, 1) == '"') && (substr($regs[1], -1) =='"') ) {
                $regs[1] = substr($regs[1], 1);
                $regs[1] = substr($regs[1], 0, -1);
            }

            if ($regs[1]{0} == '/') {
                /* Absolute path, we use it unchanged. */
                $new_dir = $regs[1];
            } else {
                /* Relative path, we append it to the current working directory. */
                $new_dir = Session::get('cwd') . '/' . $regs[1];
            }

            /* Transform '/./' into '/' */
            while (strpos($new_dir, '/./') !== false) {
                $new_dir = str_replace('/./', '/', $new_dir);
            }

            /* Transform '//' into '/' */
            while (strpos($new_dir, '//') !== false) {
                $new_dir = str_replace('//', '/', $new_dir);
            }

            /* Transform 'x/..' into '' */
            while (preg_match('|/\.\.(?!\.)|', $new_dir)) {
                $new_dir = preg_replace('|/?[^/]+/\.\.(?!\.)|', '', $new_dir);
            }

            if ($new_dir == '') {
                $new_dir = '/';
            }

            /* Try to change directory. */
            if (@chdir($new_dir)) {
                Session::put('cwd', $new_dir);
            } else {
              $output->push("cd: could not change to: $new_dir\n");
            }

            /* history command (without parameter) - output the command history */
        }elseif (trim($command) == 'history') {
            $i = 1 ;
            $hisdata = array();
            foreach (Session::get('history') as $histline) {
                $hisdata[] = $i.'  '.$histline;
                $i++;
            }
            $output->push($hisdata);
            /* history command (with parameter "-c") - clear the command history */
        } elseif (trim($command) == 'clear') {
            $this->clearscreen();
            return redirect()->back();
        } else {

            /* The command is not an internal command, so we execute it after
             * changing the directory and save the output. */
            if (@chdir(Session::get('cwd'))) {

                // We canot use putenv() in safe mode.
                if (!ini_get('safe_mode')) {
                    // Advice programs (ls for example) of the terminal size.
                    putenv('ROWS=' . Session::get('rows'));
                    putenv('COLUMNS=' . Session::get('columns'));
                }

                /* Alias expansion. */
                $length = strcspn($command, " \t");
                $token = substr($command, 0, $length);
                if (isset(Session::get('ini')['aliases'][$token])) {
                    $command = Session::get('ini')['aliases'][$token] . substr($command, $length);
                }
                $io = array();
                $p = proc_open(
                    $command,
                    array(1 => array('pipe', 'w'),
                          2 => array('pipe', 'w')),
                    $io
                );

                /* Read output sent to stdout. */
                while (!feof($io[1])) {
                    $line=fgets($io[1]);
                    if (function_exists('mb_convert_encoding')) {
                        /* (hopefully) fixes a strange "htmlspecialchars(): Invalid multibyte sequence in argument" error */
                        // $line = mb_convert_encoding($line, 'UTF-8', 'UTF-8');
                        $line = trim(preg_replace('/\s+/', ' ', $line));
                    }
                    // ls result
                    $output->push($line);
                    // $_SESSION['output'] .= htmlspecialchars($line, ENT_COMPAT, 'UTF-8');
                }
                /* Read output sent to stderr. */
                while (!feof($io[2])) {
                    $line=fgets($io[2]);
                    if (function_exists('mb_convert_encoding')) {
                        /* (hopefully) fixes a strange "htmlspecialchars(): Invalid multibyte sequence in argument" error */
                        // $line = mb_convert_encoding($line, 'UTF-8', 'UTF-8');
                        $line = trim(preg_replace('/\s+/', ' ', $line));
                    }
                    // $output->push($line);
                }

                // $output = implode(" ",$output->toArray());

                fclose($io[1]);
                fclose($io[2]);
                proc_close($p);
            } else { /* It was not possible to change to working directory. Do not execute the command */
                $output->push('output',"PHP Shell could not change to working directory. Your command was not executed.\n");
            }
        }
        Session::put('output', $output->toArray());
        $result = array(
          'success' => true,
          'message' => 'success',
          'data'    => array(
            'output'    => Session::get('output'),
            'cwd'       => Session::get('cwd'),
          ),
        );
        return $result;
      }
    } catch (\Exception $e) {
      $result = array(
          'success' => false,
          'message' => 'something wrong check your function',
          'data'    => $e,
      );
      return $result;
    }
  }

  function clearscreen()
  {
    Session::put('output',array());
  }
}
