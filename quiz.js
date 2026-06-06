let questions = [];
let currentQuestion = 0;
let userAnswers = {};
let totalTime = 600; // 10 minutes

const questionText = document.getElementById("questionText");
const optionsContainer = document.getElementById("optionsContainer");
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const questionNumbers = document.getElementById("questionNumbers");
const questionCounter = document.getElementById("questionCounter");
const progressFill = document.getElementById("progressFill");
const timeDisplay = document.getElementById("time");

/* ===========================
   LOAD QUESTIONS FROM DB
=========================== */

fetch("get-questions.php")
    .then(response => response.json())
    .then(data => {
        questions = data;

        if (questions.length === 0) {
            questionText.innerText = "No questions found.";
            return;
        }

        loadQuestion(currentQuestion);
        startTimer();
    })
    .catch(error => {
        console.error("Error loading questions:", error);
    });

/* ===========================
   LOAD QUESTION
=========================== */

function loadQuestion(index) {
    const q = questions[index];

    questionText.innerText = q.question;
    optionsContainer.innerHTML = "";
    nextBtn.disabled = true;

    q.options.forEach((option, i) => {
        const div = document.createElement("div");
        div.classList.add("option");
        div.innerText = option;

        div.onclick = () => selectOption(i);

        if (userAnswers[index] === i) {
            div.classList.add("selected");
            nextBtn.disabled = false;
        }

        optionsContainer.appendChild(div);
    });

    questionCounter.innerText = `Question ${index + 1} of ${questions.length}`;
    progressFill.style.width = `${((index + 1) / questions.length) * 100}%`;

    prevBtn.disabled = index === 0;

    updateQuestionNumbers();
}

/* ===========================
   SELECT OPTION
=========================== */

function selectOption(optionIndex) {
    userAnswers[currentQuestion] = optionIndex;

    const allOptions = document.querySelectorAll(".option");
    allOptions.forEach(opt => opt.classList.remove("selected"));

    allOptions[optionIndex].classList.add("selected");
    nextBtn.disabled = false;
}

/* ===========================
   NAVIGATION
=========================== */

nextBtn.onclick = () => {
    if (currentQuestion < questions.length - 1) {
        currentQuestion++;
        loadQuestion(currentQuestion);
    } else {
        submitQuiz();
    }
};

prevBtn.onclick = () => {
    if (currentQuestion > 0) {
        currentQuestion--;
        loadQuestion(currentQuestion);
    }
};

/* ===========================
   QUESTION NUMBER CIRCLES
=========================== */

function updateQuestionNumbers() {
    questionNumbers.innerHTML = "";

    questions.forEach((_, index) => {
        const span = document.createElement("span");
        span.innerText = index + 1;

        if (index === currentQuestion) {
            span.classList.add("active");
        }

        if (userAnswers[index] !== undefined) {
            span.classList.add("answered");
        }

        span.onclick = () => {
            currentQuestion = index;
            loadQuestion(index);
        };

        questionNumbers.appendChild(span);
    });
}

/* ===========================
   TIMER
=========================== */

function startTimer() {
    const timer = setInterval(() => {
        let minutes = Math.floor(totalTime / 60);
        let seconds = totalTime % 60;

        timeDisplay.innerText =
            `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

        totalTime--;

        if (totalTime < 0) {
            clearInterval(timer);
            submitQuiz();
        }
    }, 1000);
}

/* ===========================
   SUBMIT QUIZ
=========================== */

function submitQuiz() {
    let correct = 0;

    questions.forEach((q, index) => {
        if (userAnswers[index] === q.correct) {
            correct++;
        }
    });

    let total = questions.length;
    let percentage = Math.round((correct / total) * 100);

    const form = document.createElement("form");
    form.method = "POST";
    form.action = "score.php";

    const fields = {
        score: correct,
        total: total,
        percentage: percentage,
        quiz_id: 1,
        quiz_title: "JavaScript Fundamentals"
    };

    for (let key in fields) {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = fields[key];
        form.appendChild(input);
    }

    document.body.appendChild(form);
    form.submit();
}