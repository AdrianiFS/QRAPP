export default class errorClass {
    constructor() {
        this.errors = {};
    }

    get(field) {
        if (this.errors[field]) {
            // console.log(this.errors[field][0]);
            // return this.errors[field][0];
            // return this.errors.message;
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        delete this.errors[field];
    }
}

// <div
// v-for="(error, i) in errors"
// :key="i"
// class="FormValidationContainer"
// >
// <p v-if="errors.length"></p>
// <p>Please correct the following error(s):</p>
// <ul>
//     <li>{{ error }}</li>
// </ul>
// </div>
// <p>{{ status200 }}</p>
// </div>
