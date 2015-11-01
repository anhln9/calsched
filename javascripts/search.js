$(document).ready(function() {
    var messages = ["How about we go and feed the birds?", "Andddd an apple a day keeps the doctor away.",
    "I'm off to see the wizards.", "But tomorrow is another day.", "Oh yeah, I need to sleep. Zzzzz.",
    "Want some BBQ chicken dipped in sweet and spicy sauce and ten cheese sticks on the side? Yum.", "Time for tea.", "No soup for you!",
    "Quiz time. What did Cafe 3 serve today? a.roasted chicken b.grilled chicken c.fried chicken or d.curry chicken",
    "Squirrels squirrels squirrels squirrels squirrels", "[Luke:] I can’t believe it. [Yoda:] That is why you fail."];

    $("#findScheduleRealtime").click(function(event) {
        event.preventDefault();
        $(".alert").hide();
        if ($("#buildingRealtime").val() != "") {
            $.ajax({
                url: 'scraper.php',
                data: {
                    'semester': $("#semester:checked").val(),
                    'building': $("#buildingRealtime").val()
                },
                success: function(response) {
                    if (response == '') {
                        $("#fail").html("Sorry, couldn't find any class... " + messages[Math.floor((Math.random() * 11))]).fadeIn();
                    }
                    else {
                        $("#success").html(response).fadeIn();
                    }
                }
            });
        } else {
            $("#noBuilding").fadeIn();
        }
    });

    $("#findSchedulePlan").click(function(event) {
        event.preventDefault();
        $(".alert").hide();
        if ($("#buildingPlan").val() != "") {
            $.ajax({
                url: 'scraper.php',
                data: {
                    'semester': $("#semester:checked").val(),
                    'building': $("#buildingPlan").val(),
                    'dw': $("#dw").val(),
                    'hr': $("#hr").val()
                },
                success: function(response) {
                    if (response == '') {
                        $("#fail").fadeIn();
                    }
                    else {
                        $("#success").html(response).fadeIn();
                    }
                }
            });
        } else {
            $("#noBuilding").fadeIn();
        }
    });
});