import ChooseGameType from '../../components/ChooseGameType.vue'
import GameTypeSettings from '../../components/GameTypeSettings.vue'

const routes = [
  {
    path: '/game/start', component: ChooseGameType
  },
  {
    path: '/game/start/:id', component: GameTypeSettings
  }
]

export default routes
