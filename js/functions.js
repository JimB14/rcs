
function confirm_submit(){
    var message = "Click OK to submit.\n Click cancel to review or make changes before submitting.";
    var response = confirm(message);         
        if (response) {
            confirm("Once submitted, all form content will be erased. Click OK to submit.");
            return;
        };
}


