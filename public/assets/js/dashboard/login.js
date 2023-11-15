// login validation
document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function (event) {
        const emailInput = document.getElementById("email");

        const validEmail = isValidEmail(emailInput.value);

        if (!validEmail) {
            emailInput.classList.add("is-invalid");
            event.preventDefault();
        } else {
            emailInput.classList.remove("is-invalid");
        }
    });

    function isValidEmail(email) {
        return /\S+@\S+\.\S+/.test(email);
    }
});

// registerform validation
document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");

    registerForm.addEventListener("submit", function (event) {
        const nameInput = document.getElementById("name");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirmPassword");

        const validEmail = isValidEmail(emailInput.value);
        const validName = isValidName(nameInput.value);
        const validPassword = isValidPassword(passwordInput.value);

        if (!validEmail) {
            document.getElementById("emailError").textContent = "برجاء ادخال بريد الكتروني صحيح.";
            document.getElementById("emailError").style.display = "block";
            emailInput.classList.add("is-invalid");
            event.preventDefault();
        } else {
            document.getElementById("emailError").style.display = "none";
            emailInput.classList.remove("is-invalid");
        }

        if (!validName) {
            document.getElementById("nameError").textContent = "برجاء ادخال اسم مستخدم صحيح.";
            document.getElementById("nameError").style.display = "block";
            nameInput.classList.add("is-invalid");
            event.preventDefault();
        } else {
            document.getElementById("nameError").style.display = "none";
            nameInput.classList.remove("is-invalid");
        }

        if (!validPassword) {
            document.getElementById("passwordError").textContent = "برجاء ادخال كلمة سر لا تقل عن 8 احرف وتحتوي على حرف كبير واحد على الاقل.";
            document.getElementById("passwordError").style.display = "block";
            passwordInput.classList.add("is-invalid");
            event.preventDefault();
        } else {
            document.getElementById("passwordError").style.display = "none";
            passwordInput.classList.remove("is-invalid");
        }

        // التحقق من تطابق كلمتي المرور
        if (passwordInput.value !== confirmPasswordInput.value) {
            document.getElementById("confirmPasswordError").textContent = "كلمتي المرور غير متطابقتين.";
            document.getElementById("confirmPasswordError").style.display = "block";
            confirmPasswordInput.classList.add("is-invalid");
            event.preventDefault();
        } else {
            document.getElementById("confirmPasswordError").style.display = "none";
            confirmPasswordInput.classList.remove("is-invalid");
        }
    });

    // توضيح أنه يجب تنفيذ وظائف الفحص هنا
    function isValidEmail(email) {
        return /\S+@\S+\.\S+/.test(email);
    }

    function isValidName(name) {
        if (/^[a-zA-Z]+$/.test(name)) {
            return name.length >= 3;
        } else if (/^[\u0600-\u06FF]+$/.test(name)) {
            return name.length >= 2;
        } else {
            return false;
        }
    }

    function isValidPassword(password) {
        const capitalLetter = /[A-Z]/.test(password);
        const minLength = password.length >= 8;
    
        return capitalLetter && minLength;
    }
});