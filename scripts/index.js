$(document).ready(function () {

    var getUrl = window.location;
    var burl = getUrl.protocol + "//" + getUrl.host + getUrl.pathname;
    $.ajax({
        url: 'fetch.php',
        mothod: 'post',
        dataType: 'json',
        success: function (data) {
            let string = '';
            $.each(data, function (key, value) {
                console.log(value['taskname']);
                string += `<tr>
                <td>${value['taskname']}</td>
                <td>${value['priority']}</td>
                </tr>`;
            });
            $('#taskslist').append(string);
        },
        error: {

        }
    });

    function display_data(array) {
        var html = "<table border='2|2'>";
        array.forEach(element => {
            console.log(element.taskname);
            html += "<tr id='edit_table'>";
            html += "<td class='task_id'>" + element.id + "</td>";
            html += "<td class='etaskname'>" + element.taskname + "</td>";
            html += "<td class='epriority'>" + element.priority + "</td>";
            html += '<td><button type="button" class="btn" name="edit" id="edit" class="edit"><i class="fa fa-edit"></i></button></td>';
            html += '<td><button type="button" class="btn" name="save"   id="save" class="save"><i class="fa fa-save"></i></button></td>';
            html += '<td><button type="button" class="btn" name="delete" id="delete" class="delete"><i class="fa fa-trash"></i></button></td>';
            html += "</tr>";

        });

        html += "</table>";
        $("#taskslist").html(html);

    }

    //fetch_data(response);

    $.get(burl + "/tasks", { display: 1 }, function () { }, "json").done(function (response) {
        console.log(response);
        console.log("i`m in display");
        display_data(response);
    });
    //==============================save=====================================


    $(document).on('click', "#save", function (e) {
        e.preventDefault();
        var taskName = "";
        var priority = "";
        var id = "";
        $(this).parent().siblings('td.task_id').each(function () {
            id = $(this).html();
            console.log(id);
        });

        console.log("i`m in savvvveee");
        $('input.in_taskname').each(function () {
            taskName = $(this).val();
            console.log("input taskname" + taskName);
            $(this).html(taskName);
            $(this).contents().unwrap();
        });
        $('input.in_priority').each(function () {
            priority = $(this).val();
            console.log("input priority" + priority);
            $(this).html(priority);
            $(this).contents().unwrap();
        });
        $(this).siblings('#edit').show();
        $(this).siblings('#delete').show();
        $(this).hide();

        error = false;
        if (taskName == "") {
            $(".task_error").html("Pls enter taskname!");
            error = true;
        } else {

            $(".task_error").html("");
            error = false;
        }

        if (priority == "") {
            $(".priority_error").html("Pls enter a task priority !");
            error = true;
        } else {

            $(".priority_error").html("");
            error = false;

        }

        if (error == false) {

            console.log("i`m in update!");
            $(".priority_error").html("");
            $(".task_error").html("");
            $.ajax({
                url: burl + "/update",
                method: 'PUT',
                dataType: 'json',
                data: {
                    update: 1, id: id,
                    taskName: taskName
                    , priority: priority
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 'success') {
                        window.location.href = burl + "/";
                        console.log("updated");
                    } else {
                        console.log(response);

                    }
                }
            });

        }
    });





    //======================================add====================================
    $(document).on('click', '#add', function (e) {

        e.preventDefault();
        let btn = $(this).parent().parent().parent().find('#btn');
        var taskName = $("#taskname").val(),
            priority = btn.text();
        // fetch_data([taskName, priority]);
        if (taskName == "") {
            $("#task_error").html("please enter task");
            error = true;
        }
        else {
            $("#task_error").html("");

            error = false;

        }
        if (priority === "NoPriority") {
            $("#priorty_error").html("please select task priority");
            error = true;
        }
        else {
            $("#priorty_error").html("");

            error = false;

        }
        if (error == false) {

            $.post(burl + "/add",
                {
                    saveSubmit: true,
                    taskName: taskName,
                    priority: priority
                },
                function () { }, "json").
                done(function (response) {
                    if (response.status == 'success') {
                        display_data(response);
                        console.log(response);
                        window.location.href = burl + "/";
                    } else {
                        console.log("something wrong !!");
                    }
                });



        }

    });

    //===================================edit===========================================
    $(document).on('click', "#edit", function (e) {
        e.preventDefault();
        var taskName = "";
        var priority = "";
        $(this).parent().siblings('td.etaskname').each(function () {
            taskName = $(this).html();
            $(this).html('<input class="in_taskname" value="' + taskName + '" required />');
            console.log(taskName);
        });
        $(this).parent().siblings('td.epriority').each(function () {
            priority = $(this).html();
            $(this).html('<input class="in_priority" value="' + priority + '" required />');
            console.log(priority);
        });
        $(this).siblings('#save').show();
        $(this).siblings('#delete').show();
        $(this).hide();


    });

    //=================================delete================================


    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var id = "";
        $(this).parent().siblings('td.task_id').each(function () {
            id = $(this).html();
            console.log(id);
        });
        console.log("delete?!");
        console.log(id);
        $.ajax({
            url: burl + "/delete",
            method: 'delete',
            dataType: 'json',
            data: { delete: 1, id: id },
            success: function (response) {
                console.log("done!");
                console.log(response);
                if (response.status == 'success') {
                    console.log("deleted");
                    $.get(burl + "/tasks", { display: 1 }, function () { }, "json").done(function (response) {
                        console.log(response);
                        display_data(response);

                    });
                } else {
                    console.log("something went wrong!");
                }

            }
        });

    });



    // priorty button setting
    (function ($) {

        $.fn.PriorityBtn = function () {
            var events = function () {
                $('a[name=priority]').on('click', switchBtn);
            };

            var switchBtn = function () {
                let btn = $(this).parent().parent().parent().find('button');
                let selectedPrior = $(this);

                switchPriority(btn, selectedPrior);
                switchBtnStyle(btn);

                if (selectedPrior.text() === 'NoPriority') {
                    selectedPrior.remove();
                }
            };

            var switchPriority = function (currentPriorBtn, newPriorA) {
                const btnText = currentPriorBtn.text();
                const aText = newPriorA.text();
                newPriorA.text(btnText);
                currentPriorBtn.text(aText);
            };

            var switchBtnStyle = function (btn) {
                const btnText = btn.text();
                //console.log("btnText" + btnText);
                btn.removeClass();
                switch (btnText) {
                    case 'High':
                        btn.addClass('btn btn-danger btn-sm dropdown-toggle');
                        break;
                    case 'Low':
                        btn.addClass('btn btn-success btn-sm dropdown-toggle');
                        break;
                    case 'Medium':
                        btn.addClass('btn btn-warning btn-sm dropdown-toggle');
                        break;

                }
            };

            events();

            return this;
        };

    }(jQuery));

    // attach to all buttons
    $('.priority-btn').PriorityBtn();
});