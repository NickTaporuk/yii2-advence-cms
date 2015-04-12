App ={};
App.Social = {
    not_agree_terms: false,
	init: function() {
		$("[data-auth-provider]").on("click", function(e) {
			$('.progress, .wait-override').show();
			var provider = $(this).data("auth-provider");
			App.Social.auth(provider);
			e.preventDefault();
		});
	},
	auth: function(provider, e) {
        if ($('#not_agree_check').length && $('#not_agree_check').prop('checked') == false) {
            App.Social.not_agree_terms = true;
        }

		App.Social.providers[provider].auth(e);
	}
};

App.ready.push(App.Social.init);

App.Social.providers = {
    google: {
        auth: function(cb) {
            OAUTHURL    =   'https://accounts.google.com/o/oauth2/auth?';
            VALIDURL    =   'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=';
            SCOPE       =   'https://www.googleapis.com/auth/userinfo.profile+email https://www.google.com/m8/feeds';
            CLIENTID    =   GOOGLE_CLIENTID;
            REDIRECT    =   GOOGLE_REDIRECT || 'http://flirchi.ru';
            TYPE        =   'token';
            _url        =   OAUTHURL + 'scope=' + SCOPE + '&client_id=' + CLIENTID + '&redirect_uri=' + REDIRECT + '&response_type=' + TYPE;

            var win         =   window.open(_url, "windowname1", 'width=800, height=600');

            var pollTimer   =   window.setInterval(function() {
                try {
                    if (win.document.URL.indexOf(REDIRECT) != -1) {
                        window.clearInterval(pollTimer);
                        var url =   win.document.URL;
                        acToken =   App.Social.providers.google.gup(url, 'access_token');
                        tokenType = App.Social.providers.google.gup(url, 'token_type');
                        expiresIn = App.Social.providers.google.gup(url, 'expires_in');
                        win.close();

                        App.Social.providers.google.validateToken(acToken, cb);
                    }
                } catch(e) {
                }
            }, 100);
        },

        validateToken: function (token, cb) {
            $.ajax({
                url: VALIDURL + token,
                data: null,
                success: function (responseText) {
                    if (typeof cb == 'function') {
                        cb(responseText);
                    }else {
                        App.Social.providers.google.getUserInfo();
                    }
                },
                dataType: "jsonp"
            });
        },

        gup: function (url, name) {
            name = name.replace(/[[]/, "\[").replace(/[]]/, "\]");
            var regexS = "[\?#&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(url);
            if (results == null)
                return "";
            else
                return results[1];
        },

        getUserInfo: function () {
            $.ajax({
                url: 'https://www.googleapis.com/oauth2/v2/userinfo?access_token=' + acToken,
                data: null,
                success: function (resp) {
                    resp.google = true;
                    resp.birthday = null;
                    resp.photo_url = resp.picture;
                    resp.not_agree_terms = App.Social.not_agree_terms;
                    $.post("/sign/welcome", resp);
                },
                dataType: "jsonp"
            });
        },

        getFriends: function (cb) {
            $.ajax({
                url: 'https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=1000&start-index=1&access_token=' + acToken,
                data: null,
                success: function (resp) {
                    if (typeof cb == 'function') {
                        cb(resp);
                    }
                },
                dataType: "jsonp"
            });
        }
    },
    odnoklassniki: {
        auth: function(cb) {
            var OAUTHURL    =   'http://www.odnoklassniki.ru/oauth/authorize?';
            var TYPE        =   'code';
            var _url        =   OAUTHURL + '&client_id=' + ODNKL_CLIENTID + '&redirect_uri=' + ODNKL_REDIRECT + '/&response_type=' + TYPE;
            var REDIRECT    =   ODNKL_REDIRECT || 'http://flirchi.ru';
            var win         =   window.open(_url, "windowname1", 'width=800, height=600');

            var pollTimer   =   window.setInterval(function() {
                try {
                    if (win.document.URL.indexOf(REDIRECT) != -1) {
                        window.clearInterval(pollTimer);
                        var url =   win.document.URL;
                        var code =   App.Social.providers.odnoklassniki.gup(url, 'code');

                        win.close();

                        App.Social.providers.odnoklassniki.validateCode(code);
                    }
                } catch(e) {
                }
            }, 100);
        },

        validateCode: function (code) {
            document.location.href="/sign/odnkl?code=" + code;
        },

        gup: function (url, name) {
            name = name.replace(/[[]/, "\[").replace(/[]]/, "\]");
            var regexS = "[\?#&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(url);
            if (results == null)
                return "";
            else
                return results[1];
        }
    },
	yandex: {
		initialized: true,
		auth: function() {
			document.location.href = 'https://oauth.yandex.ru/authorize?response_type=code&client_id=' + App.context.yandexAppId;
		}
	},
	facebook: {
		initialized: false,
		scope: "email, user_birthday, user_photos",
		init: function() {
			this.initialized = true;
		},
		checkPermissions: function(perms, cb) {
			var needed_permissions = [];
			if (typeof perms == "function") {
				cb = perms;
				perms = null;
			}

			perms = perms || this.scope;
			FB.api({
				method: "fql.query", 
				query: "SELECT " + perms + " FROM permissions WHERE uid = me()"
			}, function(r) {
				$.each(r[0], function(k, v) {
					if (v == 0) {
						needed_permissions.push(k);
					}
				});

				if (needed_permissions.length) {
					FB.ui({
						method: "permissions.request", 
						perms: needed_permissions.join(","), 
						display: "dialog"
					}, function(r) {
						if (cb) cb(r);
					});
				} else {
					if (cb) cb({
						perms: perms
					});
				}
			});
		},
		auth: function() {
			if (!this.initialized) {
				this.init();
			}

			var session = FB.getAuthResponse();
			if (session) {
				var data = {
					status: "connected",
					authResponse: session
				};

				this.checkPermissions($.proxy(function() {
					return this.onLogin(data);
				}, this));
			} else {
				FB.login($.proxy(this.onLogin, this), {
					scope: this.scope
				});
			}
		},
		post: function(id, data, cb) {
			//FB.api(id + "/feed", "POST", data, function(r) {
			//	if (r.error) {
			//		App.track_rt('fb-wall-post-fail');
				//$.post('/jse', {m: r.error.message + ', code: ' + r.error.code});
			//	}

			//	if (cb) cb();
			//});
		},
		invite: function(ids, message, data, cb) {
			FB.ui({
				method: "apprequests", 
				to: ids, 
				message: message, 
				data: data/*,
				new_style_message: true,
				filters: ["app_non_users"]*/
			}, function(r) {
				if (r && r.request && (r.to.length > 0)) {
					var ids = {};
                    App.track_rt('social-invite-send', r.to.length);
                    App.track_rt('social-invite-send-unique', 1);
					App.Facebook.getFriends().done(function(friends) {
						var in_apps = [], users = {};
						jQuery.each(friends, function(k, friend) {
							if (friend.is_app_user) {
								in_apps.push(friend.uid);
							}
						});
						
						jQuery.each(r.to, function(k, uid){
							if (jQuery.inArray(uid, in_apps) != -1) {
								users[uid] = 1;
							} else {
								users[uid] = 0;
							}
						});
						
						ids = jQuery.extend({}, users); 
						
						//$.post("/api/track/fb", {
						//	notification: ids,
						//	type: data.type,
						//	type_id: data.type_id,
						//	log: $.cookie('fb_log_requests') ? 1 : 0,
						//	friends: friends.length,
						//	token: App.context.token || 0
						//});
						
					});

				}
				if (cb) cb(r);
			});
		},
		getInfo: function() {
			var d = $.Deferred();
			FB.api("me", function(user) {
				var data = {
					email: user.email,
					name: user.first_name,
					photo_url: "http://graph.facebook.com/" + user.id + "/picture?width=800",
					gender: user.gender,
					birthday: user.birthday
				};
				d.resolve(data);
			});
			return d.promise();
		},
		getFriends: function() {
			var d = $.Deferred();
			FB.api("me/friends?fields=id,first_name,birthday&limit=1000", function(response) {
				var friends = response.data;
				var data = [];
				$.each(friends, function(key, friend) {
					data.push({
						id: friend.id,
						name: friend.first_name,
						birthday: friend.birthday
					});
				});
				d.resolve(data);
			});
			return d.promise();
		},
		getPhotos: function() {
			var d = $.Deferred();
			FB.api("me/albums", function(response) {
				var albums = response.data;
				if (!albums) {
					return d.resolve();
				}

				var data = [];
				var profileAlbumId = null;
				for (var i in albums) {
					if (albums[i].type == "profile") {
						profileAlbumId = albums[i].id;
						break;
					}
				}

				if (!profileAlbumId) {
					return d.resolve();
				}

				FB.api(profileAlbumId + "/photos", function(response) {
					var photos = response.data;
					$.each(photos, function(key, photo) {
						data.push(photo.source);
					});
					d.resolve(data);
				});
			});
			return d.promise();
		},
		onLogin: function(session) {
			if (session.status == "connected" && session.authResponse) {
				$.when(this.getInfo()).then($.proxy(function(info, friends, photos) {
					info.friends = friends;
					info.photos = photos;
					info.fb = true;
					info.fb_id = session.authResponse.userID;
					info.token = session.authResponse.accessToken;
					info.channel = 'FB_application';
                    info.not_agree_terms = App.Social.not_agree_terms;
					$.post("/sign/welcome", info);
				}, this));
			}
		}
	},
	mailru: {
		initialized: false,
		scope: ["stream", "photos"],
		init: function() {
			this.initialized = true;

			mailru.events.listen(mailru.connect.events.login, $.proxy(function(response) {
				this.onLogin(response);
			}, this));
		},
		auth: function() {
			if (!this.initialized) {
				this.init();
			}

			mailru.connect.login(this.scope);
		},
		getInfo: function() {
			var d = $.Deferred();
			mailru.common.users.getInfo(function(response) {
				var user = response[0];
				if (!user) {
					return d.reject('Authorization failed');
				}
				var data = {
                    mm_id: user.uid,
					email: user.email,
					name: user.first_name,
					photo_url: user.has_pic ? user.pic_big : undefined,
					gender: user.sex,
					birthday: user.birthday,
					city_title: user.location != undefined ? user.location.city.name : undefined,
					country_title: user.location  != undefined ? user.location.country.name : undefined
				};
				d.resolve(data);
			});
			return d.promise();
		},
		getFriends: function() {
			var d = $.Deferred();
			mailru.common.friends.getExtended(function(friends) {

				var data = [];
				$.each(friends, function(key, friend) {
					data.push({
						id: friend.uid,
						link: friend.link,
						name: friend.first_name,
						photo: friend.has_pic ? friend.pic_big : undefined,
						gender: friend.sex,
						birthday: friend.birthday
					});
				});
				d.resolve(data);
			});
			return d.promise();
		},
		getPhotos: function() {
			var d = $.Deferred();
			mailru.common.photos.get(function(photos) {
				var data = [];
				$.each(photos, function(key, photo) {
					data.push(photo.src);
				});
				d.resolve(data);
			}, "_myphoto");
			return d.promise();
		},
		onLogin: function() {
			$.when(this.getInfo(), this.getFriends()).then($.proxy(function(info, friends) {
				info.friends = friends;
				info.mm = true;
                info.not_agree_terms = App.Social.not_agree_terms;
				$.post("/sign/welcome", info);
			}, this));
		}
	},
	vk: {
		initialized: false,
		init: function() {
			this.initialized = true;
		},
        gup: function (url, name) {
            name = name.replace(/[[]/, "\[").replace(/[]]/, "\]");
            var regexS = "[\?#&]" + name + "=([^&#]*)";
            var regex = new RegExp(regexS);
            var results = regex.exec(url);
            if (results == null)
                return "";
            else
                return results[1];
        },
		auth: function() {
			if (!this.initialized) {
				this.init();
			}

            var OAUTHURL    =   'https://oauth.vk.com/authorize?';
            var TYPE        =   'code';
            var _url        =   OAUTHURL + 'client_id=' + VK_CLIENTID + '&scope=email&redirect_uri=' + VK_REDIRECT + '&response_type=' + TYPE + '&v=5.21';
            var REDIRECT    =   VK_REDIRECT || 'http://flirchi.ru';
            var win         =   window.open(_url, "windowname1", 'width=800, height=600');

            var pollTimer   =   window.setInterval(function() {
                try {
                    if (win.document.URL.indexOf(REDIRECT) != -1) {
                        window.clearInterval(pollTimer);
                        var url =   win.document.URL;
                        var code =   App.Social.providers.vk.gup(url, 'code');

                        win.close();

                        App.Social.providers.vk.validateCode(code);
                    }
                } catch(e) {
                }
            }, 100);
		},
        validateCode: function (code) {
            document.location.href="/sign/vk?code=" + code;
        },
        getInfo: function() {
			var d = $.Deferred();
			var callbackVk = function(r) {
				if (r.response) {
					var user = r.response[0];
                    console.log(user);
					var data = {
						email: user.email ? user.email : user.uid + '@vkontakte.ru',
						name: user.first_name,
						photo_url: user.photo_big,
						gender: user.sex,
						birthday: user.bdate
					};
					
					d.resolve(data);
				}

			};
			var params = {
				uids: App.context.vkID || '',
				fields: "uid, first_name, photo_big, sex, bdate, email",
                scope: "email"
			};

			if (App.context.apiMode == 'vk') {
				VK.Auth.login( function(r) {
					if (!r.session) return;
					if (!params.uids) {
						params.uids = r.session.mid;
					}
					VK.api("users.get", params, callbackVk);
				}, 6 );
			} else {
				VK.Auth.login( function(r) {
					if (!r.session) return;

					
					if (!params.uids) {
						params.uids = r.session.mid;
					}
					
					VK.Api.call('users.get', params, $.proxy(callbackVk, this));
				}, 6 );
			}
			return d.promise();
		},
		getFriends: function() {
			var d = $.Deferred();
			VK.api("friends.get", {
				uid: App.context.vkID, 
				count: 500
			}, function(r) {
				var data = [];

				if (!r.response) {
					d.resolve(data);
				} else if (r.response.length) {
					VK.api("users.get", {
						uids: r.response.join(","), 
						fields: "uid, first_name, photo_big, sex, bdate", 
						test_mode: 1
					}, function(r) {
						var friends = r.response;
						$.each(friends, function(key, friend) {
							data.push({
								id: friend.uid,
								name: friend.first_name,
								sex: friend.sex,
								photo: friend.photo_big,
								bdate: friend.bdate
							});
						});
						d.resolve(data);
					});
				} else {
					d.resolve(data);
				}
			});
			return d.promise();
		},
		onLogin: function() {
			$.when(this.getInfo()).then(function(info) {

//				info.friends = friends;
				info.vk = true;
				if (typeof App.context.em != 'undefined') {
					info.em = App.context.em;
				}
				info.vk_id = App.context.vkID;
				info.channel = 'VK_application';
                info.not_agree_terms = App.Social.not_agree_terms;
				$.post("/sign/welcome", info, function(response) {
					if (typeof response != 'undefined' &&  typeof response.show_confirm != 'undefined') {
						App.vkConfirmEmail();
					}
				});
			});
		}
	},
	hotmail: {
		init: function() {
			this.initialized = true;
		},
		onLogin: function() {
			var url = 'http://' + App.context.host + '/oauth/login?service=hotmail&params%5Bdisplay%5D=popup';

			var width = 640;
			var height = 480;
			var top = ($(window).innerHeight() - height) / 2;
			var left = ($(window).innerWidth() - width) / 2;
			var param = 'menubar=no,location=yes,resizable=yes,scrollbars=yes,status=no,width='+width+',height='+height+',top='+top+',left='+left;
			if (typeof App.context.ht != 'undefined' && App.context.ht == 2) {
				document.location = url;
			} else {
				window.open(url, '', param);
			}
			return false;
		},
		auth: function(cb){
			if (!this.initialized) {
				this.init();
			}
			this.onLogin();
		}
	},
	yahoo: {
		init: function() {
			this.initialized = true;
		},
		onLogin: function() {
			var url = 'http://' + App.context.host + '/oauth/login?service=yahoo&params%5Bdisplay%5D=popup';

			var width = 640;
			var height = 480;
			var top = ($(window).innerHeight() - height) / 2;
			var left = ($(window).innerWidth() - width) / 2;
			var param = 'menubar=no,location=yes,resizable=yes,scrollbars=yes,status=no,width='+width+',height='+height+',top='+top+',left='+left;
			if (typeof App.context.yh != 'undefined' && App.context.yh == 2) {
				document.location = url;
			} else {
				window.open(url, '', param);
			}


			return false;
		},
		auth: function(cb){
			if (!this.initialized) {
				this.init();
			}
			this.onLogin();
		}
	}
};
