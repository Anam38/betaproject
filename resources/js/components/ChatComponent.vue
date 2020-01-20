<template>
    <div class="col-12">
        <div class="chat-box-left">
            <div class="chat-search">
              <div class="form-group" style="margin-top: -17px;">
                <div class="float-left">
                  <h4 class="page-title">Chats</h4>
                </div>
                <div class="float-right">
                  <button type="button" class="btn btn-light waves-effect waves-light mb-3 new-chat" name="button" v-on:click="newchat()"><i class="far fa-edit"></i></button>
                </div>
              </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" id="chat-search" name="chat-search" class="form-control" placeholder="Search"> <span class="input-group-append"><button type="button" class="btn btn-primary shadow-none"><i class="fas fa-search"></i></button></span></div>
                </div>
            </div>
            <!--end chat-search-->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 780px;">
                <div class="tab-content chat-list slimscroll" id="pills-tabContent" style="overflow: hidden; width: auto; height: 780px;">
                    <div class="tab-pane fade active show" id="general_chat">
                      <div class=""  v-for="(listItem, index) in listChat" :key="index" >
                        <a href="#" class="media new-message" v-on:click="openchat(listItem.id,listItem)" title="">
                            <div class="media-left"><img src="http://remotecould.site/assets/adminTemplate/assets/images/widgets/opp-1.png" alt="user" class="rounded-circle thumb-md">
                            </div>
                              <!-- media-left -->
                              <div class="media-body">
                                  <div class="d-inline-block">
                                      <h6 v-if="listItem.user_id_2 == user.id">{{ listItem.name_1 }}</h6>
                                      <h6 v-else>{{ listItem.name_2 }}</h6>
                                      <p v-if="MessageID == listItem.id">{{ placeholderMessage }}</p>
                                      <p v-else >{{ listItem.last_message }}</p>
                                  </div>
                                  <div>
                                    <span>20 Feb</span>
                                    <span v-if="(isNotif > 0 && MessageID == listItem.id)">{{ isNotif }}</span>
                                  </div>
                              </div>
                            <!-- end media-body -->
                        </a>
                      </div>
                        <!--end media-->
                    </div>
                    <!--end general chat-->
                    <!--end group chat-->

                    <!--end personal chat-->
                </div>
                <div class="slimScrollBar" style="background: rgb(118, 129, 173); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 664px;"></div>
                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
            <!--end tab-content-->
        </div>
        <!--end chat-box-left -->
        <div class="chat-box-right">
          <div class="text-center" v-if="isContent">
            <i class="mdi mdi-wechat" style="font-size:250px;"></i>
            <h1>Chats</h1>
          </div>
          <div v-else>
            <div class="chat-header">
                <a href="#" class="media">
                    <div class="media-left"><img src="http://remotecould.site/assets/adminTemplate/assets/images/widgets/opp-1.png" alt="user" class="rounded-circle thumb-md"></div>
                    <!-- media-left -->
                    <div class="media-body">
                        <div>
                            <h6 class="mb-1 mt-0"> {{ UserName }} </h6>
                            <p class="mb-0" v-if="isOnline == 1">Online</p>
                            <p class="mb-0" v-else-if="isOnline == 2">Read..</p>
                            <p class="mb-0" v-else>Offline</p>
                        </div>
                    </div>
                    <!-- end media-body -->
                </a>
                <!--end media-->
            </div>
            <!-- end chat-header -->
            <div class="chat-body" style="overflow:auto;">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 610px;">
                    <div class="chat-detail slimscroll" style="overflow: hidden; width: auto; height:0px;min-height: 55px;"  v-for="(message, index) in messages" :key="index" v-chat-scroll>
                        <!--isi chats-->
                        <div class="media" v-if="message.user_id == user.id">
                            <div class="media-body reverse">
                                <div class="chat-msg" style="margin-right:0px" >
                                    <p style="padding-left:16px">{{ message.message }}</p>
                                </div>
                            </div>
                          </div>
                            <!--end media-body-->
                        <div class="media" v-else>
                            <div class="media-body ">
                              <div class="chat-msg" style="margin-left:0px" >
                                  <p style="padding-left:16px">{{ message.message }}</p>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="slimScrollBar" style="background: rgb(118, 129, 173); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 610px;"></div>
                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
                <!-- end chat-detail -->
            </div>
            <!-- end chat-body -->
            <div class="chat-footer">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <input @keydown="senTypingEvent" v-on:keyup="statusUpdate('id')" @keyup.enter="sendMessage(MessageID)" v-model="newMessage" type="text" class="form-control" placeholder="Type something here...">
                    </div>
                    <!-- col-8 -->
                    <div class="col-3 text-right">
                        <div class="d-none d-sm-inline-block chat-features"><a href="#"><i class="fas fa-camera"></i></a> <a href="#"><i class="fas fa-paperclip"></i></a> <a href="#"><i class="fas fa-microphone"></i></a></div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end chat-footer -->
          </div>
        </div>
        <!--end chat-box-right -->

        <!-- modal  -->
        <div id="modal-newchat" class="modal fade bs-example-modal-sm show" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none; padding-right: 17px;" aria-modal="true">
          <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title mt-0" id="mySmallModalLabel">New Chat</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>
                  <div class="modal-body">
                    <div class="bg-light mb-2" style="padding:5px;" v-for="(userItem, index) in usersAll" :key="index" v-if="userItem.id !== user.id">
                      <a href="#" class="media new-message" v-on:click="sendnewchat(userItem.id)">
                        <div class="media-left"><img src="http://remotecould.site/assets/adminTemplate/assets/images/widgets/opp-1.png" alt="user" class="rounded-circle thumb-md">
                            <span class="round-10 bg-success" v-if="isOnline"></span>
                            <span class="round-10 bg-danger" v-else></span>
                        </div>
                        <!-- media-left -->
                        <div class="media-body ml-3">
                            <div class="d-inline-block">
                                <h6>{{ userItem.name }}</h6>
                            </div>
                        </div>
                        <div class="dropdown d-inline-block float-right">
                          <a class="nav-link dropdown-toggle mr-n2 mt-n2" id="drop2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-ellipsis-v text-muted"></i>
                          </a></div>
                      </a>
                      </div>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>
    </div>
</template>

<script>
    // button get data for delete
    $(document).on('click','.new-chat',function() {
      $('#modal-newchat').modal('show');

    })
    export default {
      props:['user'],
      data() {
        return {
          messages            : [],
          users               : [],
          usersAll            : [],
          listChat            : [],
          userOnline          : '',
          newMessage          : '',
          UserName            : '',
          UserID              : '',
          MessageID           : '',
          placeholderMessage  : '',
          isNotif             : 0,
          isOnline            : 0,
          isContent           : true,
          typingTimer         : false,
        }
      },
      created() {
        // get message
        // this.fetchMessages();
        // get user all
        // this.fetchUsers();
        // get user all list chat
        this.fetchListChats();
        // get broadcast message
        Echo.join('chat')
              .here(user => {
                this.users = user;
              })
              .joining(user => {
                if(this.userOnline == user.id){
                  this.isOnline = 1;
                }
              })
              .leaving(user => {
                if(this.userOnline == user.id){
                  this.isOnline = 0;
                }
              })
              .listen('MessageEvent',(event) => {
                var isTrue = this.listChat.filter(item => item.id == event.message.message_id);
                if(isTrue.length > 0){
                  this.messages.push(event.message);
                  this.isNotif = isTrue.length
                  this.MessageID = event.message.message_id
                  this.placeholderMessage = event.message.message
                  this.isOnline = 1;
                };
              })
              .listen('UpdateMessageStatus',(event) => {
                if(event.status > 0){
                  this.isOnline = 2;
                }
              })
              .listenForWhisper('typing', user => {
                console.log(user);
                if (this.typingTimer) {
                  clearTimeout(this.typingTimer);
                }
                this.typingTimer = setTimeout(() => {
                  this.isOnline = 3;
                },3000);
              })
      },
      methods: {
        // get data message base on user
        fetchMessages(id) {
            axios.post('chat/messagesGet', { id: id }).then(response => {
              this.isContent = false;
              this.messages = response.data;
            })
          },
        // get data user
        fetchUsers() {
            axios.get('chat/users').then(response => {
              this.usersAll = response.data;
            })
        },
        // create new chat
        newchat() {
          this.fetchUsers();
        },
        // get list chats
        fetchListChats() {
          axios.get('chat/listchat').then(response => {
              this.listChat = response.data
          })
        },
        //submit new chat
        sendnewchat(userid) {
          axios.post('chat/newchat', { id: userid }).then(response => {
            this.listChat.push(response.data);
            // console.log(response.data);
          })
        },
        // get data message base on user id
        openchat(messageId, User) {
          var userId = '';
          if(this.user.id == User.user_id_1){
            this.UserName = User.name_2;
            this.userOnline = User.user_id_2;
            userId = User.user_id_2;
          }else {
            this.UserName = User.name_1;
            this.userOnline = User.user_id_1;
            userId = User.user_id_1;
          }
          // check if user choose same with user online
          var isTrue = this.users.filter(item => item.id == userId);
          if (isTrue.length > 0) {
            this.isOnline = 1
          }else {
            this.isOnline = 0
          }

          this.MessageID = messageId;

          if(this.isNotif > 0){
            this.statusUpdate(messageId);
          }
          this.isNotif = 0;
          this.fetchMessages(messageId);
        },
        //update status chat to read
        statusUpdate(id) {
          axios.post('chat/statuschat', { id: id }).then(response => {
          })
        },
        // send message
        sendMessage(messageId) {
          this.messages.push({
            user: this.user,
            message: this.newMessage
          });
          axios.post('chat/messagesSend', {
            message: this.newMessage,
            message_id: messageId
          })
        },
        senTypingEvent() {
          Echo.join('chat')
              .whisper('typing', this.user);
        }
      }
    }
</script>
