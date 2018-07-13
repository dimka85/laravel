import ChooseGameType from '../../components/ChooseGameType.vue'
import GameTypeSettings from '../../components/GameTypeSettings.vue'
import SearchGame from '../../components/SearchGame.vue'

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
  }
]

export default routes
