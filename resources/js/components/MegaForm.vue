<template>
    <div class="upAndDelFormContainer">
        <div class="formTitle">
            <h2>Create URL</h2>
        </div>
        <form class="forms">
            <div class="formInner createFormContainer">
                <div class="inputContainer">
                    <input
                        type="text"
                        class=" qrInput generatedUrl qrInputCreate"
                        placeholder="Ref"
                        v-model="generatedUrlCreate"
                        ref="generatedUrlCreate"
                        v-focus
                        name="generatedUrlCreate"
                        required
                    />
                    <i
                        class="far fa-times-circle resetIcon"
                        @click.prevent="resetForm1()"
                    ></i>
                </div>

                <div class="inputContainer">
                    <input
                        type="text"
                        class="qrInput redirectionUrl qrInputCreate"
                        placeholder="URL"
                        v-model="redirectionUrlCreate"
                        ref="redirectionUrlCreate"
                        required
                    />
                    <i
                        class="far fa-times-circle resetIcon"
                        @click.prevent="resetForm2()"
                    ></i>
                </div>

                <button
                    class="qrBtn addRessource"
                    type="submit"
                    title="Add new URL"
                    @click.prevent="createResource()"
                >
                    Add Entry
                </button>
            </div>
        </form>

        <div class="formTitle formTitleUpAndDel">
            <h2 id="form2Title ">Update or delete URL</h2>
            <div class="inputContainer">
                <input
                    v-model="searchInput"
                    type="text"
                    placeholder="Search"
                    class="qrInputCreate searchInput"
                />
                <i class="fas fa-search resetIcon"></i>
            </div>
        </div>

        <!-- ******************** -->

        <form class="forms" @submit.prevent="updateResource">
            <div
                class="formInner updateFormInner"
                v-for="(url, index) in filteredUrl"
                :key="index"
                :class="{ everyOtherColor: index % 2 == 0 }"
            >
                <a
                    :href="link + url.generatedUrl"
                    target="_blank"
                    id="qrLink"
                    title="Print"
                >
                    <i class="fas fa-print Iprint"></i>
                </a>
                <input
                    type="text"
                    class=" qrInput generatedUrl"
                    :value="url.generatedUrl"
                    ref="generatedUrl"
                    disabled
                />
                <div class="erromsg">
                  <p>{{errors}}</p>
                </div>
                <input
                    type="text"
                    class="qrInput"
                    :value="url.redirectionUrl"
                    ref="redirectionUrl"
                    required
                />
                <button
                    type="submit"
                    title="Update redirection URL"
                    @click.prevent="updateResource($refs, index)"
                >
                    <i class="fa fa-save Isave"></i>
                </button>
                <button
                    title="Delete URLs"
                    @click="deleteChanges(url.id)"
                    @click.prevent="deleteResource($refs, index)"
                >
                    <i class="fa fa-trash ItrashBin"></i>
                </button>
            </div>
        </form>


<!-- <p v-if="status200.length">{{status200}}</p> -->

  <p v-if="status200.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(sts,i) in status200" :key="i">{{ sts }}</li>
    </ul>

        <div class="errorsDiv">
            <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="(error,i) in errors" :key="i">{{ error }}</li>
    </ul>
  </p>


        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            responseAxios: [],
            generatedUrlCreate: "",
            redirectionUrlCreate: "",
            generatedUrl: "",
            redirectionUrl: "",
            token: window.token,
            urlData: "",
            responseStatus: "",
            status200:[],
            link: "http://127.0.0.1:8000/qrpages/qrGenerator?generatedUrl=",
            // link: 'http://198ded842f8b.ngrok.io/qrpages/qrGenerator?generatedUrl= ',
            searchInput: "",
            id: null,
            errors: [],
            errorObject:{error:''}
        };
    },
    directives: {
        focus: {
            inserted: function(el) {
                el.focus();
            }
        }
    },
    mounted() {
        this.loadUrl();
    },
    computed: {
        filteredUrl: function() {
            if (!this.searchInput.length) {
                return this.responseAxios;
            }
            return this.responseAxios.filter(url => {
                return url.generatedUrl.match(this.searchInput);
            });
        }
    },
    methods: {
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
        updateResource(refs, id) {
            const generatedUrl = refs.generatedUrl[id].value;
            const redirectionUrl = refs.redirectionUrl[id].value;
            // let formPosition= this.$refs.formPosition.indexOf(this.$refs.formPosition[id]);
            //  this.link += refs.generatedUrl[id].value
            axios
                .post("/qrpages/updateResource", {
                    generatedUrl: generatedUrl,
                    redirectionUrl: redirectionUrl
                })
                .then(response => {
                    response;

                    this.responseStatus = response.status;
                    // console.log(response, "res status");
                    this.loadUrl();
                    this.checkForm(redirectionUrl);
                })
                .catch(error => {
                    console.log(error.response.data.message, "in update");
                    const errorMsg = error.response.data.message;
                    this.errors.push(errorMsg);
                   
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
                    console.log(error, "update");
                });
        },
        resetForm1() {
            this.$refs["generatedUrlCreate"].value = "";
        },
        resetForm2() {
            this.$refs["redirectionUrlCreate"].value = "";
        },
        createResource() {
            axios
                .post("/qrpages/store", {
                    generatedUrl: this.generatedUrlCreate,
                    redirectionUrl: this.redirectionUrlCreate
                })
                .then(response => {
                    response.data;
                    this.urlData = response;
                    this.loadUrl();
                    this.updateChangesWhenCreate();
                })
                .catch(error => {
                    console.log(error.response.data, "error");
                });
        },
        updateChangesWhenCreate() {
            if (
                this.$refs["generatedUrlCreate"].length > 0 &&
                this.$refs["redirectionUrlCreate"].length > 0
            ) {
                this.responseAxios.unshift(this.urlData);
            }
        },
        deleteChanges(id) {
            this.responseAxios = this.responseAxios.filter(url => {
                return url.id !== id;
            });
        },
        checkForm(refs) {
            this.errors = [];
            this.status200=[]
            // console.log(refs, index, 'check form');
            // let formPosition= this.$refs.formPosition.indexOf(this.$refs.formPosition[id]);
            // console.log(this.$refs.formPosition.indexOf(this.$refs.formPosition[index]) );
            if (this.responseStatus === 200) {
                // this.status200 = "Sent properly to DataBase";
                 this.status200.push("Sent properly to DataBase");
                // alert( "Sent properly to DataBase");
            }
            if (this.responseStatus >= 300) {
                this.errors.push("Not sent properly to DataBase");
            }
            if (
                this.$refs["generatedUrlCreate"].length <= 0 &&
                this.$refs["redirectionUrlCreate"].length <= 0
            ) {
                this.errors.push("Not sent properly to DataBase");
            }
            if (!refs) {
                this.errors.push("RedirectionUrl required");
            }
            if (!this.errors.length) {
                return true;
            }
        }
    }
};
</script>
<style>
.updateFormInner {
    width: 100% !important;
    margin: 0 auto;
}
.upAndDelFormContainer {
    width: 92%;
    margin: 50px auto;
}
.trashBin,
.saveBtn,
.printIcon {
    width: 30px !important;
    background: none;
    /* border: none !important; */
}
/* .trashBin:hover::after{

    background: none;
    content: 'Delete URLs';
} */

.Iprint {
    /* color: rgb(6, 86, 172); */
    color: #435d7d;
}
.Isave {
    color: rgb(255, 202, 40);
}
.ItrashBin {
    color: rgb(241, 89, 156);
}
.displayMessage {
    display: none;
}
#myImg {
    width: 50px;
    height: 50px;
}
.inputContainer {
    position: relative;
    width: 30%;
}
.qrInput {
    position: relative;
}
.resetIcon {
    position: absolute;
    right: 5%;
    top: 30% !important;
    color: gray;
}
.qrInputCreate {
    width: 100% !important;
}
.everyOtherColor {
    background-color: rgb(251, 251, 251);
}
.addRessource {
    background-color: rgb(90, 185, 92);
    color: #fff;
    font-size: 11px;
}
/* .none{ */
/* display: none; */
/* visibility: hidden; */
/* } */
/* button{
  border: none;
  width: 32px;
  height: 32px;
  background-color: red;
  transition: all ease-in-out 0.1s;
  cursor: pointer;
} */
/* button:hover{ */
/* border: 1px solid #888;
  background-color: #ddd;
} */
</style>


