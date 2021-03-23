$(function() {

    // $('.arrow-expert').on("click", function(){
    //     console.log('sdsdsdd');
    //     let getActivePlan = $(this).parent().parent();
    //
    //     if($(getActivePlan).hasClass('active-plan')){
    //         $(getActivePlan).removeClass('active-plan');
    //     }else {
    //         $(getActivePlan).addClass('active-plan');
    //     }
    //     console.log(getActivePlan);
    //
    // });

    $('.table-expert tr').on("click", function(){
        let getActivePlan = $(this).parent().parent();

        if($(this).hasClass('active-plan')){
            $(this).removeClass('active-plan');
        }else {
            $(this).addClass('active-plan');
        }

    });

    // function to handle package click
    function handleChangePackage(event) {
        let packageName = event.currentTarget.classList[1]
        $("#invoicePackage").text(packageName)
    }

    // function to handle date click
    function handleDateChange(event) {
        if ($(this).hasClass('disabled')) {
            return false
        } else {
            $(this).addClass("selected");
            $(".day").not(this).removeClass("selected");

            let date = event.target.innerText
            $("#invoiceDate").text(date)
        }
    }

    // let finishFormBtn = $('a[href="#finish"]');
    // $(finishFormBtn).on("click",function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: 'POST',
    //         url: 'https://kyleschaeffer.com/feed/',
    //         data: { postVar1: 'theValue1', postVar2: 'theValue2' },
    //         beforeSend:function(){
    //             // this is where we append a loading image
    //             $('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
    //         },
    //         success:function(data){
    //             // successful request; do something with the data
    //             $('#ajax-panel').empty();
    //             $(data).find('item').each(function(i){
    //                 $('#ajax-panel').append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
    //             });
    //         },
    //         error:function(){
    //             // failed request; give feedback to user
    //             $('#ajax-panel').html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
    //         }
    //     });
    // });

    // function to handle time click
    function handleTimeChange(event) {
        if ($(this).hasClass('disabled')) {
            return false
        } else {
            $(this).addClass("selected");
            $(".time").not(this).removeClass("selected");

            let time = event.target.innerText;
            $("#invoiceTime").text(time);
            $('#stepTwoButton').removeClass('disabled')
        }

    }

    // function to handle name input change
    function handleNameInputChange(event) {
        let invoiceName = event.target.value;
        if (!invoiceName) {
            $('#nameRequired').css('display', 'block');
            $(this).addClass('has-error');
            stepThreeIsFormValid = false
        }

        else if (invoiceName.length < 4) {
            $('#nameCharacter').css("display", "block");
            $(this).addClass('has-error');
            stepThreeIsFormValid = false
        }
        else {
            $('#nameCharacter').css("display", "none");
            $('#nameRequired').css('display', 'none');
            $(this).removeClass('has-error');
            stepThreeIsFormValid = true;
            $("#invoiceName").text(invoiceName)
        }

    }

    // function to handle family input change
    function handleFamilyInputChange(event) {
        let invoiceFamily = event.target.value;
        if (!invoiceFamily) {
            $('#familyRequired').css('display', 'block');
            $(this).addClass('has-error');
            stepThreeIsFormValid = false
        }
        else if (invoiceFamily.length < 4) {
            $('#familyCharacter').css("display", "block");
            $(this).addClass('has-error');
            stepThreeIsFormValid = false
        }
        else {
            $('#familyCharacter').css("display", "none");
            $('#familyRequired').css('display', 'none');
            $(this).removeClass('has-error');
            stepThreeIsFormValid = true;

            $("#invoiceFamily").text(invoiceFamily)
        }


    }

    // Initialze events on DOM
    $(".package").click(handleChangePackage);
    $(".day").click(handleDateChange);
    $(".time").click(handleTimeChange);
    $("#nameInput").blur(handleNameInputChange);
    $("#familyInput").blur(handleFamilyInputChange);



});

