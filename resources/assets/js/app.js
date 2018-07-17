import router from './router'
import store from './store'
import VueChatScroll from 'vue-chat-scroll'
import VueTimeago from 'vue-timeago'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

Vue.use(VueChatScroll)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
  'choose-game-type',
  require('./components/ChooseGameType.vue'))

Vue.component(
  'game-type-settings',
  require('./components/GameTypeSettings.vue'))

Vue.component(
  'search-game',
  require('./components/SearchGame.vue'))

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue')
)

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue')
)

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue')
)

Vue.component('chat-room', require('./components/laravel-video-chat/ChatRoom.vue'))
Vue.component('group-chat-room', require('./components/laravel-video-chat/GroupChatRoom.vue'))
Vue.component('video-section', require('./components/laravel-video-chat/VideoSection.vue'))
Vue.component('file-preview', require('./components/laravel-video-chat/FilePreview.vue'))

Vue.use(VueTimeago, {
  name: 'timeago', // component name, `timeago` by default
  locale: 'en-US',
  locales: {
    'en-US': ['сейчас', ['%s сукунду назад', '%s секунд назад'], ['%s минуту назад', '%s минут назад'],
      ['%s час назад', '%s часов назад'], ['%s день назад', '%s дней назад'], ['%s неделю назад',
        '%s недель назад'], ['%s месяц назад', '%s месяцев назад'], ['%s год назад', '%s лет назад']]
  }
})

const app = new Vue({
  el: '#app',
  router,
  store
})
