<?php
    if(isset($_SESSION["err"])){
        $class = $_SESSION["err"]["err"] ? "bg-danger opacity-50" : "bg-success opacity-50";

        echo '<div class="'. $class .'" id="err-alert">
                <p class="text-light">'. $_SESSION["err"]["msg"] .'</p>
            </div>
            <script>
                const errAlert = document.querySelector("#err-alert");
                
                setTimeout(() => {
                    errAlert.classList.add("show-err-alert");
                }, 500)

                setTimeout(() => {
                    errAlert.classList.remove("show-err-alert");
                }, 5000)
            </script>
            ';
    }

