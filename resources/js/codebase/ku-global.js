

window.getDistricts = async function (url, zone_id) {
    let res = await axios.get(url, {
        params: {
            zone_id: zone_id
        }
    });
    return res;
}

window.getThanas = async function (url, district_id) {
    let res = await axios.get(url, {
        params: {
            district_id: district_id
        }
    });
    return res;
}
window.getVillages = async function (url, thana_id) {
    let res = await axios.get(url, {
        params: {
            thana_id: thana_id
        }
    });
    return res;
}


