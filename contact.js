document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);
    const responseBox = document.getElementById("responseMessage");

    fetch("process.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {

        responseBox.style.display = "block";

        if (data.includes("success")) {
            responseBox.className = "response-message success";
            responseBox.innerText = data;
            form.reset();
        } else {
            responseBox.className = "response-message error";
            responseBox.innerText = data;
        }
    })
    .catch(() => {
        responseBox.style.display = "block";
        responseBox.className = "response-message error";
        responseBox.innerText = "Something went wrong!";
    });
});