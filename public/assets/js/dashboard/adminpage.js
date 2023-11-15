// side bar resposive toggle
let sidebarOpen = true;
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');
    const nav = document.querySelector('.nav');

    if (window.innerWidth <= 767) {
        if (sidebarOpen){
            sidebar.style.right = '0';
            content.style.marginRight = '0';
            content.classList.add('black-and-white');
            nav.style.right = '60vw';
            
        }else{
            sidebar.style.right = '-60vw';
            content.style.marginRight = '0';
            content.classList.remove('black-and-white');
            nav.style.right = '0';
        }
        
    } else {
        if (sidebarOpen) {
            sidebar.style.right = '-22vw';
            content.style.marginRight = '0px';
            nav.style.right = '0';
        } else {
            sidebar.style.right = '0';
            content.style.marginRight = '22vw';
            nav.style.right = '22vw';
        }
    }

    sidebarOpen = !sidebarOpen;
}

// ========== change li active in side bar and change div in content to show

function hideAllSections() {
    const sections = document.querySelectorAll(".content > div");
    sections.forEach((section) => {
        section.style.display = "none";
    });
}

function setActiveTab(tabId) {
    const tabs = document.querySelectorAll(".sidebar li");
    tabs.forEach((tab) => {
        tab.classList.remove("active");
    });

    document.getElementById(tabId).classList.add("active");
}

document.getElementById("statistics-link").addEventListener("click", function () {
    hideAllSections();
    document.getElementById("statistics").style.display = "block";
    setActiveTab("statistics-link");
});

document.getElementById("new-article-link").addEventListener("click", function () {
    hideAllSections();
    document.getElementById("newArticle").style.display = "block";
    setActiveTab("new-article-link");
});

document.getElementById("published-articles-link").addEventListener("click", function () {
    hideAllSections();
    document.getElementById("publishedArticles").style.display = "block";
    setActiveTab("published-articles-link");
});
document.getElementById("bookedConsultations-link").addEventListener("click", function () {
    hideAllSections();
    document.getElementById("bookedConsultations").style.display = "block";
    setActiveTab("bookedConsultations-link");
});
document.getElementById("messages-link").addEventListener("click", function () {
    hideAllSections();
    document.getElementById("messages").style.display = "block";
    setActiveTab("messages-link");
});
document.getElementById("changePass-link").addEventListener("click", function () {
    hideAllSections();
    document.getElementById("changePass").style.display = "block";
    setActiveTab("changePass-link");
});

hideAllSections();
document.getElementById("statistics").style.display = "block";
setActiveTab("statistics-link");
// ====================== circle chart
const circlechart = document.getElementById('circlechart');

// console.log(monthMessages);
const monthMessagesDec = decodeURI(monthMessages.replace(/&quot;/g, '"'));
const jsomMessages = JSON.parse(monthMessagesDec);
// console.log(jsomMessages);

const monthlyCounts = Array(12).fill(0); 

jsomMessages.forEach(message => {
    const createdDate = new Date(message.created_at);
    const month = createdDate.getMonth();
    monthlyCounts[month]++;
});

// console.log(monthlyCounts);

new Chart(circlechart, {
    type: 'polarArea',
    data: {
        labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسيمبر'],
        datasets: [{
            label: 'رسالة شهرية',
            data: monthlyCounts,
            borderWidth: 0,
            backgroundColor: [
                '#ff507d',
                '#65B9FF',
                '#A0BF05',
                '#F29C1F'
            ]
        }]
    },
    options: {
        responsive: true,
        scales: {
            r: {
                pointLabels: {
                    display: false,
                    centerPointLabels: true,
                    font: {
                        size: 14
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: false,
            }
        }
    },
});

// ====================== line chart 
// console.log(weekViewsGroupBy);
const decodedWeekView = decodeURI(weekViewsGroupBy.replace(/&quot;/g, '"'));
const weekViewsArray = JSON.parse(decodedWeekView);
// console.log(weekViewsArray);

let resultObject = {};
for (const key in weekViewsArray) {
    if (weekViewsArray.hasOwnProperty(key)) {
        const date = key.split(' ')[0];
        if (resultObject[date]) {
            resultObject[date] += weekViewsArray[key].length;
        } else {
            resultObject[date] = weekViewsArray[key].length;
        }
    }
}

// console.log(resultObject);

let endDate = new Date();
let startDate = new Date(endDate.getTime() - 6 * 24 * 60 * 60 * 1000);
let viewsLastSevenDays = [];

for (let i = 0; i < 7; i++) {
    let currentDate = new Date(startDate.getTime() + i * 24 * 60 * 60 * 1000).toISOString().slice(0, 10);
    if (resultObject[currentDate]) {
        viewsLastSevenDays.push(resultObject[currentDate] || 0);
    } else {
        viewsLastSevenDays.push(0);
    }
}

// console.log(viewsLastSevenDays);


const linechart = document.getElementById('linechart');

const lastdates = new Date();

const labels = [];
for (let i = -6; i <= 0; i++) {
    const day = new Date(lastdates);
    day.setDate(lastdates.getDate() + i);
    labels.push(day.toLocaleDateString('ar-EG', { year: 'numeric', month: 'long', day: 'numeric' }));
}

new Chart(linechart, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'زيارات يومية',
            data: viewsLastSevenDays,
            borderWidth: 1,
            borderColor: '#EEB36E',
            backgroundColor: '#B3733E',
            pointRadius: 8,
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                reverse: true,
                ticks: {
                    maxRotation: 45,
                    minRotation: 45,
                    autoSkip: false,
                    color: '#B3733E',
                    font: {
                        size: 12,
                        weight: 'bold'
                    }
                },
                border: {
                    color: 'white'
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#B3733E',
                    font: {
                        size: 12,
                        weight: 'bold'
                    }
                },
                grid: {
                    display: false
                },
                border: {
                    color: 'white'
                }
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeOutBounce'
        }
    }
});


// ====================== bar chart 


// console.log(consultionBookingsGroupByMonthes);


const decodedString = decodeURI(consultionBookingsGroupByMonthes.replace(/&quot;/g, '"'));
const jsonString = JSON.parse(decodedString);
let outputArray = new Array(12).fill(0);
jsonString.forEach(item => {
    const index = item.month - 1;
    outputArray[index] = item.total;
});

// console.log(outputArray);

const barchart = document.getElementById('barchart');
new Chart(barchart, {
    type: 'bar',
    data: {
        labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسيمبر'],
        datasets: [{
            label: 'استشارة ناجحة',
            data: outputArray,
            borderWidth: 1,
            backgroundColor: [
                '#ff507d',
                '#65B9FF',
                '#A0BF05',
                '#F29C1F'
            ]
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                reverse: true,
                border: {
                    color: 'white'
                },
                ticks: {
                    color: '#B3733E',
                    font: {
                        size: 12,
                        weight: 'bold'
                    },
                    precision: 0,
                },
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#B3733E',
                    font: {
                        size: 12,
                        weight: 'bold'
                    }
                },
            }
        },
        animation: {
            duration: 2000,
            easing: 'easeOutBounce'
        }
    }
});

// ====================== text area editor
tinymce.init({
    selector: '#articledata',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
});
//================ Days and date
const currentDate = new Date();
const minDate = currentDate.toISOString().split('T')[0];

const dateInput = document.getElementById('date');
dateInput.min = minDate;


const datesArray = [];

function saveDate() {
    const selectedDate = document.getElementById('date').value;
    const dateObj = {
        date: selectedDate,
        day: getDayOfWeek(selectedDate)
    };

    datesArray.push(dateObj);
    displayDates();
}

function getDayOfWeek(dateString) {
    const daysOfWeek = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
    const date = new Date(dateString);
    const dayIndex = date.getDay();
    return daysOfWeek[dayIndex];
}

function displayDates() {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = '';

    for (let i = 0; i < datesArray.length; i++) {
        const dateObj = datesArray[i];
        const date = new Date(dateObj.date);
        const monthName = getMonthName(date.getMonth() + 1);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${i + 1}</td>
            <td>${dateObj.day}</td>
            <td>${dateObj.date}</td>
            <td>${monthName}</td>
            <td><button class="btn btn-danger" onclick="deleteDate(${i})"><i class="fa-solid fa-trash"></i></button></td>
        `;

        resultDiv.appendChild(row);
    }
}

function getMonthName(monthNumber) {
    const monthNames = [
        'يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونيو',
        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
    ];

    return monthNames[monthNumber - 1];
}

function deleteDate(index) {
    datesArray.splice(index, 1);
    displayDates();
}

// ======================= change password form
document.getElementById('changePass').addEventListener('submit', function (event) {
    var newPassword = document.getElementsByName('newpassword')[0].value;
    var renewPassword = document.getElementsByName('renewpassword')[0].value;
    var newPasswordError = document.getElementById('newPasswordError');
    var renewPasswordError = document.getElementById('renewPasswordError');

    newPasswordError.style.display = 'none';
    renewPasswordError.style.display = 'none';

    if (newPassword !== renewPassword) {
        renewPasswordError.style.display = 'block';
        event.preventDefault();
    }

    if (newPassword.length < 8 || !/[A-Z]/.test(newPassword)) {
        newPasswordError.style.display = 'block';
        event.preventDefault();
    }
});

