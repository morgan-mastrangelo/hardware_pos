let suggestions = [
    "Channel",
    "CodingLab",
    "CodingNepal",
    "YouTube",
    "YouTuber",
    "YouTube Channel",
    "Blogger",
    "Bollywood",
    "Vlogger",
    "Vechiles",
    "Facebook",
    "Freelancer",
    "Facebook Page",
    "Designer",
    "Developer",
    "Web Designer",
    "Web Developer",
    "Login Form in HTML & CSS",
    "How to learn HTML & CSS",
    "How to learn JavaScript",
    "How to became Freelancer",
    "How to became Web Designer",
    "How to start Gaming Channel",
    "How to start YouTube Channel",
    "What does HTML stands for?",
    "What does CSS stands for?",
];


const searchBox = document.querySelector("#searchBox");
const resultBox = document.querySelector("#resultBox");

let appendOnTextBox = (id) => {
    searchBox.value = id;
    searchHelper.clearEverything();
}
class SearchHelper {
    suggestions;
    searchBox;
    resultBox;
    emptyArray = [];
    constructor(suggestions, searchBox, resultBox) {
        this.suggestions = suggestions;
        this.searchBox = searchBox;
        this.resultBox = resultBox;
    }
    do() {
        this.searchBox.addEventListener('keyup', (event) => {
            let userData = event.target.value;

            if (userData) {
                this.emptyArray = suggestions.filter((data) => {

                    return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
                })
                let id = 0;
                this.emptyArray = this.emptyArray.map((data) => {
                    const litag = document.createElement("li");
                    litag.innerHTML = data;
                    litag.setAttribute("id", id);
                    this.appendOnclick(litag)
                    id++;
                    return litag;
                })
                this.insertIntoResultBox(this.emptyArray)
                this.emptyArray = []
            } else {
                this.removeChildElements();
            }

        })
    }
    appendOnclick = (litag) => {
        litag.setAttribute("onclick", `appendOnTextBox('${litag.innerHTML}')`)
    }
    clearEverything = () => {
        this.removeChildElements();
        this.emptyArray = [];
    }

    removeChildElements = () => {
        while (this.resultBox.hasChildNodes())
            this.resultBox.removeChild(this.resultBox.firstChild)

    }
    insertIntoResultBox = (array) => {

        this.removeChildElements();
        array.forEach(element => {
            this.resultBox.appendChild(element)
        });

    }
}
const searchHelper = new SearchHelper(suggestions, searchBox, resultBox);
searchHelper.do();
