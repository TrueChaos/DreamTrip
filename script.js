// получаем целевой элемент и подставляем в параметры get запроса
let seasons = [].slice.call(document.querySelectorAll("#seasons label"));
let categories = [].slice.call(document.querySelectorAll("#categories a"));
//При загрузке страницы инициализируем fetch запрос значениями по умолчанию
let season = "winter";
let category = "all";
getTour();


seasons.forEach(item => {
    item.addEventListener("click", getTour);
})

categories.forEach(item => {
    item.addEventListener("click", getTour);
})

async function getTour(){
    if(categories.includes(this)) {
        categories.forEach(item => item.style.fontWeight = "normal");
        this.style.fontWeight = "bold";
        category = this.getAttribute("name");
    }
    if(seasons.includes(this)) season = this.getAttribute("name");
    console.log(season, category);

    await fetch(`/gettour.php?season=${season}&category=${category}`).then((response) => {
        return response.text();
    })
        .then((data) => {
            tours = JSON.parse(data);
            console.log(tours)
            tours.forEach((item,i) =>{
                setTour(item,i);
             });
        })
        .catch(error => console.error(error));
}

function setTour(tour, i){
    //------Собираем внутренний каркас карточки------
    col1 = document.querySelector("#first");
    col2 = document.querySelector("#second");
    card = document.createElement("div")
    card.className = "card";
    img = document.createElement("img")
    img.className = "card-img-top"
    img.src = tour["image"];
    img.height = 400;
    card.appendChild(img);
    card_body = document.createElement("div")
    card_body.className = "card-body";
    //card body
    title = document.createElement("h4")
    title.className = "card-title";
    title.innerHTML = tour["t_name"];
    card_body.appendChild(title);
    date = document.createElement("h6")
    date.className = "card-subtitle mb-2 text-muted";
    date.innerHTML = tour["date"];
    card_body.appendChild(date);
    descr = document.createElement("p")
    descr.className = "card-text";
    descr.innerHTML = tour["descr"];
    card_body.appendChild(descr);
    price = document.createElement("h6")
    price.className = "card-subtitle mb-2 text-muted";
    price.innerHTML = tour["price"];
    card_body.appendChild(price);
    //card body
    button = document.createElement("a");
    button.className = "btn btn-danger";
    button.innerHTML = "Забронировать";
    logged = document.querySelector("#userlogged")
    if(logged) button.href = `sendorder.php?tour=${tour["id"]}`
    //привязываем кнопку к модальному окну
    else {
        let myModal = new bootstrap.Modal(document.getElementById("orderModal"), {
            keyboard: false
        })
        button.onclick = function () {
            myModal.show();
        }
    }
    card.appendChild(card_body);
    card.appendChild(button);
    if(i % 2 == 0 && i != 0){
        inner = document.querySelector("#c-inner");
        carousel_item = document.createElement("div")
        carousel_item.className = "carousel-item";
        div_row = document.createElement("div")
        div_row.className = "row justify-content-between gx-5";
        col1 = document.createElement("div")
        col2 = document.createElement("div")
        col1.className = "col";
        col1.appendChild(card);
        div_row.appendChild(col1);
        div_row.appendChild(col2);
        carousel_item.appendChild(div_row);
        inner.appendChild(carousel_item);
    }
    else if(i == 0){
        col1 = document.querySelector("#first");
        while(col1.firstChild) {
            col1.removeChild(col1.firstChild);
        }
        while(col2.firstChild) {
            col2.removeChild(col2.firstChild);
            }
        col1.appendChild(card);
        }

    else if(i == 1){
        col2.appendChild(card);
    }
    else if(i > 2 && i % 2 != 0){
        
    }

}


//получаем формы авторизации и регистрации
const forms = [].slice.call(document.getElementsByTagName("form"));

async function sendForm(n){
    let formData = new FormData(forms[n]);
    formData = Object.fromEntries(formData);
    let handler = (n == 0) ? "login.php" : "reg.php";

        await fetch(handler, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(formData)
        })
            .then(response => {
                return response.text();
            })
            .then(data => {
                alert(data);
                switch(data){
                    case "Вы вошли":
                        location = "lk.php";
                        break;
                    case "Вы зарегестрированы":
                        location = "lk.php";
                        break;
                    case "Приветствую, админ":
                        location = "admin.php";
                        break;
                }
            })
            .catch(error => console.error(error));

}
