<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Tracking</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row px-5 g-3 mt-4">
            <div class="fw-bold">เลขพัสดุ : TH111dd2d2d
                <input type="hidden" value="TH111dd2d2d" id="textInput">
                <button id="button" class="btn btn-light rounded-5"><i class="bi bi-files"></i></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#button').on('click', function(e) {
            e.preventDefault();

            /* Get the text field */
            var copyText = document.getElementById("textInput");

            /* Prevent iOS keyboard from opening */
            copyText.readOnly = true;

            /* Change the input's type to text so its text becomes selectable */
            copyText.type = 'text';

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            /* Change the input's type back to hidden */
            copyText.type = 'hidden';
        });

        // $('#copy-to-clipboard-button').on('mouseout', function(e) {
        //     var tooltip = document.getElementById("myTooltip");
        //     tooltip.innerHTML = "Copy to clipboard";
        // });

        // function copyText() {
        //     let text = document.getElementById("textInput");
        //     text.select();
        //     document.execCommand("copy");
        //     alert("Tracking number copied!");
        // }
    </script>
</body>

</html>