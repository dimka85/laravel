import ChooseGameType from '../../components/ChooseGameType.vue'
import GameTypeSettings from '../../components/GameTypeSettings.vue'
import SearchGame from '../../components/SearchGame.vue'
import ChatRoom from '../../components/laravel-video-chat/ChatRoom.vue'

const routes = [
  {
    path: '/game/start',
    component: ChooseGameType,
    children: [
      {
        path: '/game/start/:id',
        component: GameTypeSettings
      }
    ]
  },
  {
    path: '/game/search',
    component: SearchGame
  },
  {
    path: '/game/new',
    component: ChatRoom
  }
]

export default routes
