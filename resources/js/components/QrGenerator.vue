<template>
    <div class="main">
        <div id="qrCodePrint">
            <button @click="print" ref="printButton" class="iPrintQrComp">
                <p>Print</p>
                <i class="fas fa-print Iprint "></i>
            </button>
            <div ref="qrcode" id="qrcode"></div>
            <p>Reference: {{ reference }}</p>
        </div>
    </div>
</template>
<script>
import * as QRCode from "easyqrcodejs";

export default {
    data() {
        return {
            test: "hola",
            responseAxios: [],
            urlResponse: [],
            output: null,
            reference: ""
        };
    },
    mounted() {
        this.displayQr();
        this.getReference();
    },
    methods: {
        displayQr() {
            let url = window.location.href;
            let finalUrl = url.replace(/qrGenerator/, "queryString");
            console.log(finalUrl);
            console.log(url);
            let options = {
                text: finalUrl,
                width: 300,
                height: 300,
                colorDark: "#000",
                colorLight: "#fff",
                correctLevel: QRCode.CorrectLevel.H,
                dotScale: 1
            };
            new QRCode(this.$refs.qrcode, options);
        },
        print() {
            window.print();
        },
        getReference() {
            let regex = /=(.+)/;
            let url = window.location.href;
            let coincidence = url.match(regex);
            this.reference = coincidence[1];
        }
    }
};
</script>
<style scoped>
#qrcode {
    /* width: 300px; */
    margin: 50px auto 10px;
}
#qrCodePrint p {
    align-self: center !important;
}
h1 {
    text-align: center;
}
.iPrintQrComp {
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 80px;
    align-self: flex-end;
    height: 30px;
}
.iPrintQrComp p {
    margin: 0;
}
#qrCodePrint {
    display: flex;
    flex-direction: column;
    width: 315px;
    margin: 0 auto;
}

/* .navbar {
    display: none !important;
} */
</style>
