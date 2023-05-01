import Vue from "vue";

Vue.component("input-file-with-color", {
    props: ["name", "id"],
    template: `
            <div class="inputFileWithColor mb-5 d-inline-block w-100 mr-1">
                <img :class="imgPreview">
                <div class="bottom-section">
                    <label :for="id" class="btn btn-sm btn-alt-success input-file d-inline-block m-0 single-bottom d-flex justify-content-center align-items-center mr-5">
                        <input :id="id" @change="readURL" type="file" :name="fileName" style="visibility: hidden; position: absolute; width: 0; box-sizing: border-box">
                        <i class="si si-cloud-upload"></i>
                    </label>
                    <button type="button" :id="id" v-on:click="$emit('remove-list-item', id)" class="btn btn-sm btn-alt-danger single-bottom mr-5">
                        <i class="fal fa-trash-alt"></i>
                    </button>
                    <div class="d-flex flex-column">
                        <div class="color-preview mb-5" style="background: #000000;height: 20px; border-radius: 3px"></div>
                        <input id="colorPicker" :name="colorName" class="form-control" type="text" value="#000000" style="height: 20px;">
                    </div>
                </div>
            </div>`,
    computed: {
        fileName() {
            return `${this.name}[][image]`;
        },
        colorName() {
            return `${this.name}[][color]`;
        },
        imgPreview() {
            return `img-preview prview-${this.id}`;
        }
    },
    methods: {
        readURL(evt) {
            let input = evt.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document
                        .querySelector(".prview-" + input.id)
                        .setAttribute("src", e.target.result);
                };
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    }
});

var myVue = new Vue({
    el: "#vue-el",
    data: {
        inputList: [
            /*{"id": 1}*/
        ]
    },
    methods: {
        addInputList() {
            this.inputList.push({
                id: this.inputList.length ?
                    this.inputList[this.inputList.length - 1].id + 1 :
                    1
            });
        },
        removeInputList(id) {
            let filterList = this.inputList.filter(
                singleInput => singleInput.id != id
            );
            this.inputList = filterList;
        }
    }
});
