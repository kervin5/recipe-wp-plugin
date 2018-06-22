jQuery(function($){
    $("#recipe_rating").bind("rated",function () {
        $(this).rateit("readonly",true);

        var form = {
            action : "r_rate_recipe",
            rid: $(this).data('rid'),
            rating: $(this).rateit('value')
        };

        $.post(recipe_obj.ajax_url, form, function (data) {
            console.log(data);
        });
    });

    $("#recipe-form").on("submit",function (e) {
        e.preventDefault();

        $(this).hide();

        $("#recipe-status").html('<div class="alert alert-info text-center">Please wait!</div> ');

        var form = {
            action: "r_submit_user_recipe",
            content: tinymce.activeEditor.getContent(),
            title: $("#r_inputTitle").val(),
            ingredients: $("#r_inputTitle").val(),
            time: $("#r_inputTime").val(),
            utensils: $("#r_inputUtensils").val(),
            level: $("#r_inputLevel").val(),
            meal_type: $("#r_inputMealType").val()
        };

        console.log(form);

        $.post(recipe_obj.ajax_url,form).always(function (response) {
            if(response.status == 2) {
                $("#recipe-status").html('<div class="alert alert-success text-center">Recipe submitted successfully!</div> ');
            }else {
                $("#recipe-status").html('<div class="alert alert-danger text-center">Unable to submit recipe. Please fill in all fields.</div> ');
                $("#recipe-form").show();
            }
        })
    });
});