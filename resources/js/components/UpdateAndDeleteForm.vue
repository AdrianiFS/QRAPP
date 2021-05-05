<template>
    <div class="upAndDelFormContainer">
        <h2>Update or delete URL Component</h2>
        <div v-for="(shit, i) in urlData" :key="i">
            <p>{{ shit.data }}</p>
        </div>
        <form>
            <div
                class="formInner updateFormInner"
                v-for="(url, index) in responseAxios"
                :key="index"
            >
                <input
                    type="text"
                    class=" qrInput"
                    :value="url.generatedUrl"
                    ref="generatedUrl"
                    disabled
                />
                <input
                    type="text"
                    class="qrInput "
                    :value="url.redirectionUrl"
                    ref="redirectionUrl"
                />
                <button
                    class="qrBtn"
                    type="submit"
                    @click.prevent="updateResource($refs, index)"
                >
                    Update
                </button>
                <button @click.prevent="deleteResource($refs, index)">
                    Delete
                </button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props: ["urlData"],
    data() {
        return {
            generatedUrl: "",
            redirectionUrl: "",
            responseAxios: [],
            updateRes: ""
        };
    },
    mounted() {
        this.loadUrl();
    },
    methods: {
        addResourceToBottomForm(responseAxios, urlData) {
            this.responseAxios.unshift(this.urlData);
        },
        loadUrl() {
            axios
                .get("/qrpages/index")
                .then(({ data }) => {
                    this.responseAxios = data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        // hacer funtion ajax con 3 params, rutas, metodos, valores
        updateResource(refs, index) {
            const generatedUrl = refs.generatedUrl[index].value;
            const redirectionUrl = refs.redirectionUrl[index].value;
            axios
                .post("/qrpages/updateResource", {
                    generatedUrl: generatedUrl,
                    redirectionUrl: redirectionUrl
                })
                .then(response => {
                    response;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteResource(refs, index) {
            const generatedUrl = refs.generatedUrl[index].value;
            axios
                .post("/qrpages/delete", {
                    generatedUrl: generatedUrl
                })
                .then(response => {
                    response.status;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        handleResponse(statusNumber) {
            // validar response.status y despues returnar true o falso dependiendo numero entre200 y 299 >300 false, >=300 error
            // si controlador funciona,  cuando up or del me da respuesta, cuando no funciona gestiono el error avisa al cliente q la accion no funciono
        }
    }
};
</script>
<style>
.updateFormInner {
    width: 90% !important;
    margin: 50px auto;
}
.upAndDelFormContainer {
    width: 92%;
    margin: 50px auto;
}
</style>
