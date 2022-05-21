function getCity(citis, districts, wards) {
    var Parameter = {
        url: "./DiaGioiHanhChinhVN/data.json", //Đường dẫn đến file chứa dữ liệu hoặc api do backend cung cấp
        method: "GET", //do backend cung cấp
        responseType: "application/json", //kiểu Dữ liệu trả về do backend cung cấp
    };

    var promise = axios(Parameter);

    promise.then(function (result) {
        renderCity(result.data, citis, districts, wards);
    });
}

function renderCity(data, citis, districts, wards) {
    for (let x of data) {
        citis.options[citis.options.length] = new Option(x.Name, x.Id);
    }

    citis.onchange = function () {
        districts.length = 1;
        wards.length = 1;
        if (this.value != "") {
            let result = data.filter(n => n.Id === this.value);

            for (let k of result[0].Districts) {
                districts.options[districts.options.length] = new Option(k.Name, k.Id);
            }
        }
    };

    districts.onchange = function () {
        wards.length = 1;
        let dataCity = data.filter((n) => n.Id === citis.value);
        if (this.value != "") {
            let dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

            for (let w of dataWards) {
                wards.options[wards.options.length] = new Option(w.Name, w.Id);
            }
        }
    };
}