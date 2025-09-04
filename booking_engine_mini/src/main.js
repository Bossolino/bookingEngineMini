import { registerPlugins } from '@/plugins'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'
import { createApp, ref, watch } from 'vue'
import 'unfonts.css'
import axios from 'axios'
import PageNotFound from './pages/PageNotFound.vue'
import Home from '@/pages/Home.vue'
import Prenotazione from './pages/Prenotazione.vue'
import Riepilogo from './pages/RiepilogoPren.vue'

const router  = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', name: "Home", component: Home },
    { path: '/prenotazione/:nomeStanza', name: 'Prenotazione', component: Prenotazione },
    {path: '/riepilogo', name: "Riepilogo", component: Riepilogo},
    { path: '/PageNotFound', name: "PageNotFound", component: PageNotFound }
  ]
})
router.beforeEach((to, from, next) => {
  if (to.path !== "/" && to.path !== "/PageNotFound" && to.fullPath === `/prenotazione/${roomSelected.value}` && to.path !== "/riepilogo") {
    return next("/PageNotFound");
  }
  // console.log(`Reindirizzamento da ${from.fullPath} a ${to.fullPath}`);
  return next();
});

const lingua = ref(localStorage.getItem("lang") ?? 'it');
const dataArrivo = ref(new Date());
const dataPartenza = ref(new Date());
dataPartenza.value.setDate(dataArrivo.value.getDate()+1);
const adulti = ref(1);
const bambini = ref(0);
const carica = ref(false)
const camereDisp = ref([])
const roomSelected = ref(0)
const roomSelectedName = ref("")
const roomSelectedDescription = ref("")
const roomSelectedCapacity = ref(0)
const roomSelectedPrice = ref(0)
const nomeOspite = ref("")
const emailOspite = ref("")

const errPren = ref(false)
const textPren = ref("")

const giorniTotali = ref(1)
const prezzoTotale = ref()

const nessCameraDisp = ref(false)

export default {
  router,
  lingua,
  carica,
  dataArrivo,
  dataPartenza,
  camereDisp,
  adulti,
  bambini,
  roomSelected,
  roomSelectedName,
  roomSelectedDescription,
  roomSelectedCapacity,
  roomSelectedPrice,
  nomeOspite,
  emailOspite,
  errPren,
  textPren,
  giorniTotali,
  prezzoTotale,
  nessCameraDisp,
  stringData: function (date) {
    const y = date.getFullYear()
    const m = String(date.getMonth() + 1).padStart(2, '0')
    const d = String(date.getDate()).padStart(2, '0')
    return `${y}-${m}-${d}`
  },
  cercaCamere: function () {
    // console.log(this.stringData(dataArrivo.value))
    // console.log(this.stringData(dataPartenza.value))
    carica.value = true;
    camereDisp.value = [];
    axios({
      method: 'GET',
      url: 'http://localhost:8888/disponibilita',
      headers: {'Accept': 'application/json'},
      params: {
        dataA: this.stringData(dataArrivo.value),
        dataD: this.stringData(dataPartenza.value),
        adulti: adulti.value,
        bambini: bambini.value
      }
    }).then(camere => {
      if (camere.data.length === 0) {
        nessCameraDisp.value = true;
        carica.value = false;
        return;
      }
      camereDisp.value = camere.data
      carica.value = false;
      nessCameraDisp.value = false;
      // console.log(camere.data)
      // console.log(this.stringData(dataArrivo.value))
      // console.log(this.stringData(dataPartenza.value))
    }).catch(error => {
      console.log(error);
      carica.value = false;
      nessCameraDisp.value = true;
    })
  },
  confermaPren: function (){
    axios({
      method: "POST",
      url: "http://localhost:8888/prenotazione",
      data: {
        nome: nomeOspite.value,
        email: emailOspite.value,
        dataArrivo: dataArrivo.value,
        dataPartenza: dataPartenza.value,
        roomSelected: roomSelected.value
      }
    }).then(response=>{
      errPren.value = false;
      router.replace("/riepilogo");
    }).catch(error=>{
      errPren.value = true;
      textPren.value = error.data;
      router.replace("/PageNotFound");
      console.error(error)
    })
  },
  
}


const app = createApp(App)
registerPlugins(app)
app.use(router).mount('#app')
