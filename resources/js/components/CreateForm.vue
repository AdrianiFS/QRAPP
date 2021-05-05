<template>
    <div>
        <form @submit.prevent="formSubmit">
            <div class="formInner createFormContainer">
                <input
                    type="text"
                    class=" qrInput generatedUrl"
                    placeholder="generatedUrl"
                    v-model="generatedUrl"
                    ref="generatedUrl"
                />
                <input
                    type="text"
                    class="qrInput redirectionUrl"
                    placeholder="redirectionUrl"
                    v-model="redirectionUrl"
                    ref="redirectionUrl"
                />
                <button class="qrBtn" type="submit">
                    Save
                </button>
                <button class="" @click.prevent="resetForm">
                    Reset
                </button>
            </div>
        </form>
        <update-delete :urlData="urlData"></update-delete>
    </div>
</template>
<script>
export default {
    mounted() {},
    data() {
        return {
            generatedUrl: "",
            redirectionUrl: "",
            output: "",
            token: window.token,
            urlData: ""
        };
    },
    methods: {
        addResourceToBottomForm() {
            this.$emit("addResourceToBottomForm", this.urlData);
        },
        resetForm() {
            this.$refs["generatedUrl"].value = "";
            this.$refs["redirectionUrl"].value = "";
        },
        formSubmit() {
            axios
                .post("/qrpages/store", {
                    generatedUrl: this.generatedUrl,
                    redirectionUrl: this.redirectionUrl
                    // headers: {
                    //     token: this.token
                    //     // ver que parametro de token y su nombre y si hay q mandarlo a laravel
                    // }
                })
                .then(response => {
                    response.data;
                    console.log(response, "en create form");
                    this.urlData = response;
                    // usar response.data para generar un nuevo elemento en el dom
                    //  una vez post resuelto en el then, la respuesta genera un nuevo formulario con los datos actuales de la respuesta
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    }
};
</script>
<style></style>
