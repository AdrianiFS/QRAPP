/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component("create-form", require("./components/CreateForm.vue").default);

Vue.component(
    "update-delete",
    require("./components/UpdateAndDeleteForm.vue").default
);
Vue.component("mega-form", require("./components/MegaForm.vue").default);
Vue.component("qr-generator", require("./components/QrGenerator.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

// Vue.use((Vue) => {
//     // Assign a unique id to each component
//     let uuid = 0;
//     Vue.mixin({
//       beforeCreate: function() {
//         this.uuid = uuid.toString();
//         uuid += 1;
//       },
//     });

//     // Generate a component-scoped id
//     Vue.prototype.$id = function(id) {
//       return "uid-" + this.uuid + "-" + id;
//     };
//   });

// let qrBtn = select(".qrBtn");
// qrBtn.addEventListener("click", (e) => {
//     e.preventDefault();
//     let qrInput = select(".qrInput");
//     let qrImg = select(".qrImg");
// let qrcode=document.getElementById('qrcode')
//     let options = {
//         text:qrInput.value,
//         width: 256,
//         height: 256,
//         colorDark: "#000000",
//         colorLight: "#ffffff",
//         correctLevel: QRCode.CorrectLevel.H, // L, M, Q, H
//         dotScale: 1,
//     };
//     qrImg.src = new QRCode(qrcode, options);
// });
// function select(el) {
//     return document.querySelector(el);
// }

// const params = new URLSearchParams(window.location.search)
// for(let param of params){
//     alert(param[1])
// }

// const urlParams = new URLSearchParams(window.location.search);
// const myParam = urlParams.get('myParam');
// alert(myParam)

// var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
// null

// const queryString = window.location.search;
// alert(queryString)
// let k= Object.values(queryString)
// alert(k)

// const
//   keys = urlParams.keys(),
//   values = urlParams.values(),
//   entries = urlParams.entries();

// for (const key of keys) console.log(key);
// // product, color, newuser, size

// for (const value of values) console.log(value);
// // shirt, blue, , m

// for(const entry of entries) {
//  alert(`${entry[0]}: ${entry[1]}`);
// }

let url = window.location.href;
let navbar = document.querySelector(".navbar");
if (url.match("/qrpages/qrGenerator")) {
    navbar.style.display = "none";
}
