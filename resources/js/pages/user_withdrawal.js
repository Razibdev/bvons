import Vue from "vue";
const userWithdrawalList = new Vue({
    el : "#user-withdrawal-list",
    data : {
        checked : false
    },
    methods: {
        isChecked(evt) {
            let checkList = document.querySelectorAll('.withdrawal-checkbox');
            let checkedBox = false;
            checkList.forEach((el) => {
                if(el.checked) { checkedBox = true; }
            });
            if(checkedBox == true) {
                this.checked = true;
            } else {
                this.checked = false
            }
        }
    }
});

$('.paidList').on('click', function(evt) {
    const button = $(this);
    let value = parseInt(button.attr('value'));
    button.html(`<i class="fa fa-spinner fa-spin"></i>`);
    axios({
        method: 'patch',
        url: window.userWithdrawalPaidUrl,
        data: {
            'paidList' : [value],
            'singleUpdate' : true
        }
    }).then(response => {
        if(response.data === 'success') {
            button.html(`<i class="si si-check"></i>`);
            window.location.reload();
        }
    });
});

$('.refundWithdrawal').on('click', function(evt) {
    const button = $(this);
    let id = parseInt(button.attr('value'));
    button.html(`<i class="fa fa-spinner fa-spin"></i>`);
    axios({
        method: 'patch',
        url: window.userWithdrawalRefundUrl,
        data: {
            'id' : id,
            'singleUpdate' : true
        }
    }).then(response => {
        if(response.data === 'success') {
            button.html(`<i class="si action-undo"></i>`);
            window.location.reload();
        }
    });
});




