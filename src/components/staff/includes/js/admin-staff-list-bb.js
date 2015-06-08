/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */



    function htmlEncode(value){
      return $('<div/>').text(value).html();
    }
    $.fn.serializeObject = function() {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
    };
    $.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
      options.url = 'http://dev.phoenixrestorations.com' + options.url;
    });
    var offset = 0;
    var limit = 20;
    
    var Users = Backbone.Collection.extend({
      url: '/admin/staff/rest/' + offset + '/' + limit
    });
    
    var User = Backbone.Model.extend({
      urlRoot: '/admin/staff/rest'
    });
    
    var Paginators = Backbone.Collection.extend({
        url: '/admin/staff/pagination/0/20'
    });
    
    var PaginatorView = Backbone.View.extend({
      el: '.pagination',
      render: function () {
        var that = this;
        var paginators = new Paginators();
        paginators.fetch({
          success: function (paginators) {
             
            var template = _.template($('#paginator-template').html(), {paginators: paginators.models});
            that.$el.html(template);
          }
        })
      }
    });
    var paginatorView = new PaginatorView();
    var UserListView = Backbone.View.extend({
      el: '.page',
      render: function (options) {
        var that = this;
        if(options) {
          offset = options.offset;
          limit = options.limit;
          users = new Users({'offset': options.offset, 'limit': options.limit});
          users.fetch({
            success: function (users) {
              var template = _.template($('#user-list-template').html(), {users: users.models});
              that.$el.html(template);
            }
          })
        } else {
            var users = new Users({'offset': offset, 'limit': limit});
            users.fetch({
              success: function (users) {
                var template = _.template($('#user-list-template').html(), {users: users.models});
                that.$el.html(template);
              }
            })
        }
      }
    });
    var userListView = new UserListView();
    var UserEditView = Backbone.View.extend({
      el: '.edituser',
      events: {
        'submit .edit-user-form': 'saveUser',
        'click .delete': 'deleteUser'
      },
      saveUser: function (ev) {
        var userDetails = $(ev.currentTarget).serializeObject();
        var user = new User();
        user.save(userDetails, {
          success: function (user) {
            router.navigate('', {trigger:true});
          }
        });
        return false;
      },
      deleteUser: function (ev) {
        this.user.destroy({
          success: function () {
            console.log('destroyed');
            router.navigate('', {trigger:true});
          }
        });
        return false;
      },
      render: function (options) {
        var that = this;
        if(options.id) {
          that.user = new User({id: options.id});
          that.user.fetch({
            success: function (user) {    
              var template = _.template($('#edit-user-template').html(), {user: user});
              that.$el.html(template);
            }
          })
        } else {
          var template = _.template($('#edit-user-template').html(), {user: null});
          that.$el.html(template);
        }
      }
    });
    var userEditView = new UserEditView();
    var Router = Backbone.Router.extend({
        routes: {
          "": "home", 
          "edit/:id": "edit",
          "new": "edit",
        }
    });
    var router = new Router;
    router.on('route:home', function() {
      // render user list
      userListView.render();
      paginatorView.render();
    });
    
    router.on('route:edit', function(id) {
      $('#left-feature-slider-edit').toggle(true);
      userEditView.render({id: id});
    });
    
    Backbone.history.start();
    
    $('.pagination').click(function() {
        userListView.render({offset: $(this).data('offset'), limit: $(this).data('limit')});
    });