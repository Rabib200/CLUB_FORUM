try {
    profile = document.querySelector('#profile > div')
    overlay = document.getElementById("overlay")

    profile.addEventListener("click", () => {
        if (overlay.className == "slide")
            overlay.className = "slide-reverse"
        else
            overlay.className = "slide"
    })
} catch (error) {

}

try {
    $('#floatingInput').on('click', function () {
        $(this).closest('.form-floating').addClass('focus');
    });
} catch (error) {

}

try {
    x_mark = document.querySelector("#overlay menu > div span");

    x_mark.addEventListener("mouseover", () => {
        x_mark.querySelector("i").classList.add("fa-shake")
    })

    x_mark.addEventListener("mouseout", () => {
        x_mark.querySelector("i").classList.remove("fa-shake")
    })

    x_mark.addEventListener("click", () => {
        if (overlay.className == "slide")
            overlay.className = "slide-reverse"
        else
            overlay.className = "slide"
    })
}
catch (error) {

}

try {
    document.querySelector('input[type="submit"]').addEventListener('click', function (event) {
        var requiredFields = document.querySelectorAll('input:required');
        for (var i = 0; i < requiredFields.length; i++) {
            if (!requiredFields[i].value) {
                requiredFields[i].style.boxShadow = "0px 0px 8px 2px red"
                event.preventDefault();
            }
            else[
                requiredFields[i].style.boxShadow = "none"
            ]
        }
    });
}
catch (error) {

}

try {
    newEmail = document.getElementById("newemail")
    confirmemail = document.getElementById("confirmemail")

    l = [newEmail, confirmemail]
    l.forEach(e => {
        e.addEventListener("keyup", () => {
            email1 = document.getElementById("newemail").value;
            email2 = document.getElementById("confirmemail").value;
            submitBtn = document.getElementById("submit")

            if (email1 === email2)
                submitBtn.removeAttribute("disabled")
            else
                submitBtn.setAttribute("disabled", true)
        })
    });

    n_pass = document.getElementById("n_pass")
    c_pass = document.getElementById("c_pass")

    l = [n_pass, c_pass]
    l.forEach(e => {
        e.addEventListener("keyup", () => {
            pass1 = document.getElementById("n_pass").value
            pass2 = document.getElementById("c_pass").value
            submitBtn = document.getElementById("submit2")

            console.log(pass1 + " " + pass2)

            if (pass1 === pass2)
                submitBtn.removeAttribute("disabled")
            else
                submitBtn.setAttribute("disabled", true)

        })
    })


    //removing and setting required
    document.getElementById("e_change").addEventListener("click", ()=>{
        newEmail.setAttribute('required', true);
        confirmemail.setAttribute('required', true);
    });

    [document.querySelector("#changeCred button") , document.querySelector("#changeCred input[type='submit']")].forEach((e)=>{
        e.addEventListener("click", ()=>{
            newEmail.removeAttribute("required");
            confirmemail.removeAttribute("required");
        })
    })

    document.getElementById("p_change").addEventListener("click", ()=>{
        curr = document.getElementById("curr_pass");
        curr.setAttribute('required', true);
        n_pass.setAttribute('required', true);
        c_pass.setAttribute('required', true);
    });

    document.querySelector("#changePass button").addEventListener("click", ()=>{
        curr = document.getElementById("curr_pass");
        curr.removeAttribute('required');
        n_pass.removeAttribute('required');
        c_pass.removeAttribute('required');
    })



} catch (error) { }


try {
    menu_list = document.getElementById("list_menu").getElementsByTagName("li")
    const url = window.location.pathname;
    const fileName = url.substring(url.lastIndexOf('/') + 1).split(".")[0];

    Array.from(menu_list).forEach(e => {
        item = e.innerText.toLowerCase()
        if (fileName == "mainpage" && item == "news feed") {
            e.className = "active"
        }
        else if (fileName == "profile" && item == "profile") {
            e.className = "active"
        }
        else if(fileName == "task" && item == "tasks"){
            e.className = "active"
        }
        else if(fileName == "contact" && item == "contact us"){
            e.className = "active";
        }
        else if(fileName == "contact" && item == "users's msg"){
            e.className = "active";
        }
        //rest will be added soon
    })

} catch (error) { }


//signup
try {
    signup = document.getElementById("signup-div")
    s_btn = signup.querySelector("input")

    function jumpingButton() {
        randomNumber = Math.random();
        result = Math.round(randomNumber);

        pass1 = document.getElementById("password").value
        pass2 = document.getElementById("c_password").value

        if (pass1 !== "" && pass2 !== "") {
            if (pass1 !== pass2) {
                s_btn.disabled = true

                signup.classList.remove("justify-content-center")
                if (result == 0) {
                    signup.classList.add("justify-content-end")
                }
                else {
                    signup.classList.add("justify-content-start")
                }
            }
        }
    }

    signup.addEventListener("mouseover", jumpingButton);
    s_btn.addEventListener("mouseover", jumpingButton)

    signup.addEventListener("mouseout", () => {
        signup.className = "d-flex justify-content-center mb-3"
        s_btn.disabled = false

    })

} catch (error) { }


try {
    u_btn = document.querySelector("#edit-btn > div");
    form = document.querySelector("#edit-btn > form");

    u_btn.addEventListener("click", () => {
        form.classList.toggle("d-none");
        u_btn.querySelector("span").classList.toggle("d-none");
        u_btn.classList.toggle("rotate");
    })
} catch (error) {}