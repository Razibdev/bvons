<template>
    <div  :class="{'nav' : showmenumain}"  @blur="showmenumain = false">
        <div style="">
            <input type="checkbox" v-model="form.menu" name="menu" id="menu">
            <div class="label-main">
                <label class="nav-s-icon d-flex d-sm-none" style="padding-left: 10px !important;" id="nav-icon" for="menu" @click="showmenu" :class="{'nav-icon' :showmenumain}" >&#9776; </label>
                <label v-if="showmenumain" for="menu" class="second-level" @click="hideMenu">X</label>
            </div>

            <div class="multi-level" v-if="showmenumain" >
                <div class="item" v-for="navigation in test" :key="navigation.id">
                    <input type="checkbox" name="" :id="navigation.id">
                    <img class="arrow" src="https://cdn4.iconfinder.com/data/icons/ios-edge-glyph-3/25/Down-Carrot-512.png" alt=""><label :for="navigation.id">{{navigation.category_name}}</label>
                    <ul>
                        <li v-for="subcategory in navigation.subcategory_id" :key="subcategory.id"><a href="">{{subcategory.sub_category_name}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "test",
        props:['test'],
        data(){
            return{
                showmenumain: false,
                form:{
                    menu:0,
                }
            }
        },
        methods:{
            showmenu(){
                this.showmenumain = !this.showmenumain;

            },
            hideMenu(){
                this.showmenumain = false;
                this.form.menu = 0;
            }
        }
    }
</script>

<style>
    .multi-level{
        height: 95vh !important;
        overflow-y: scroll;
        z-index: 40;
    }
    .multi-level,#menu, .item ul, .nav input[type="checkbox"]{
        display: none;
    }

    #menu:checked ~ .multi-level, .item input:checked ~ul{
        display: inline-block;
    }
    .arrow{
        width: 12px;
        height: 12px;
        vertical-align: middle;
        float: left;
        z-index: 10;
        margin: 17px 1em 0 2em;

    }

    .item input + .arrow{
        transform: rotate(-90deg);
        transition: 0.1s;
    }

    .item input:checked + .arrow{
        transform: rotate(0deg);
        transition: 0.1s;
    }
    .multi-level .item{
        width: 345px;
    }
    label:hover{
        cursor: pointer;
    }
    .label-main{
        width: 100%;
        float: left;
        height:36px;
    }

    label{
        z-index: 3;
        display:block;
        position:relative;
        width: 50%;
    }
.second-level{
    right: 10px;
    float: right;
    width: 20px;
    top: -64px;
    padding: 10px;
    color: #fff;
    font-size: 28px;
}
    .nav{
        width: 90%;
        background-color: white;
        overflow-x: hidden;
        border-bottom: 1px solid #CFD8DC;
        overflow-y: auto;
        position:fixed;
        top:5px;
        z-index: 100;
        /*margin-top: 100px;*/

    }
    .nav-s-icon{
        font-size:28px;
        line-height: 50px;
        padding-left: .7em;
        top: -3px;
        color: #ffffff !important;

    }
    .nav-icon{
        font-size:28px;
        line-height: 50px;
        padding-left: 1em;
        color: white;
        background-color: black;
        width: 100%;
        display: block;
        z-index:1;
        top: -10px;
    }

    .nav ul, .nav li, label{
        line-height: 50px;
        margin: 0;
        text-decoration: none;
        color: #90A4AE;
        font-weight: 100;
        width: 100%;
        list-style: none;
        padding: 0 2em;

    }

    #nav-icon{
        padding: 0 0.6em;
    }

    .item ul{
        padding: 0 0.25em;
    }

    .nav li a{
        line-height: 50px;
        margin: 0;
        padding: 0 2em;
        list-style: none;
        text-decoration: none;
        color: #90A4AE;
        font-weight: 100;
        width: 100%;
    }


</style>