import Vue from 'vue';
const asettings = new Vue({
    el: '#adminSettings',
    data: {
        settings: adminSettings
    },
    methods: {
        changeAdminSettings  (evt) {
            let settingName = evt.target.getAttribute('name');
            let settingValue = evt.target.innerText;
            axios({
                method: 'patch',
                url: window.settingUpdateUrl,
                data: {
                    settingName,
                    settingValue
                }
            }).then(response => {
                // console.log(response);
                for (let i = 0; i < this.settings.length; i++) {
                    if(this.settings[i].setting_name === response.data.setting_name) {
                        this.settings[i].setting_value = response.data.setting_value;
                        this.settings[i].setting_default_value = response.data.setting_default_value;
                        if(this.settings[i].setting_value === null) {
                            evt.target.innerText = response.data.setting_default_value;
                        }
                    }
                }
            });

        }
    }
});


