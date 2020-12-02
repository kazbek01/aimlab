function deleteItem(ob){
    $(ob).closest('.list-item').remove();
}

function getQuestion(){
    var check = true;
    $('.test_teacher_question_id').each(function () {
        if($(this).val() == ''){
            check = false;
            return;
        }
    });

    if(check == false){
        showError($('#lang_var_1').val());
        return;
    }

    $.ajax({
        url:'/admin/test-teacher/get-question',
        type: 'GET',
        data: {
            question_count: $('.last_question_count:last').val()
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if(data.status == 0){
                showError(data.error);
                return;
            }
            $('#question_list').append(data);
        }
    });
}

function getVariant(ob,question_count){
    $.ajax({
        url:'/admin/test-teacher/get-variant',
        type: 'GET',
        data: {
            question_count: question_count,
            variant_count: $(ob).closest('.question_item').find('.last_variant_count:last').length
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if(data.status == 0){
                showError(data.error);
                return;
            }
            $('#variant_list_' + question_count).append(data);
        }
    });
}

var g_ob = '';

function saveTestTeacher() {
    $('.ajax-loader').fadeIn();
    $.ajax({
        url:'/admin/test-teacher/save',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            lesson_name: $('#lesson_name').val(),
            grade: $('#grade').val(),
            grade_type: $('#grade_type').val(),
            is_show: $('#is_show').val(),
            test_teacher_lang: $('#test_teacher_lang').val(),
            test_teacher_type_id: $('#test_teacher_type_id').val(),
            test_teacher_task_type_id: $('#test_teacher_task_type_id').val(),
            lesson_text: CKEDITOR.instances['lesson_text'].getData(),
            school_subject_id: $('#school_subject_id').val(),
            test_teacher_id: g_test_teacher_id
        },
        success: function (data) {
            $('.ajax-loader').fadeOut();

            if(data.status == false){
                $('#lesson_info_btn').click();
                showError(data.error);
                return;
            }
            g_test_teacher_id = data.test_teacher_id;

            if(g_send_save_question == 1){
                saveTestTeacherQuestion(g_ob);
            }
        }
    });
}

var g_send_save_question = 0;

function saveTestTeacherQuestion(ob) {
    if(g_test_teacher_id == ''){
        g_send_save_question = 1;
        saveTestTeacher();
        g_ob = ob;
        return;
    }

    $('.ajax-loader').fadeIn();

    var question_count = $(ob).closest('.question_item').find('.last_question_count').val();

    var question = 'ckeditor_' + question_count;

    var variant_list = [];
    $('.variant_question_' + question_count).each(function () {
        variant_list.push($(this).val());


    });

    var variant_is_correct_list = [];
    $('.variant_question_is_correct_' + question_count).each(function () {
        variant_is_correct_list.push($(this).prop("checked"));
    });

    var test_question_count = 0;
    $('.test_teacher_question_id').each(function () {
        if($(this).val() > 0){
            test_question_count = test_question_count + 1;
        }
    });

    $.ajax({
        url:'/admin/test-teacher/question',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            question: CKEDITOR.instances[question].getData(),
            test_teacher_task_type_id: $(ob).closest('.question_item').find('.test_teacher_task_type_id').val(),
            test_teacher_question_id: $(ob).closest('.question_item').find('.test_teacher_question_id').val(),
            test_teacher_id: g_test_teacher_id,
            variant_list: variant_list,
            test_question_count: test_question_count,
            variant_is_correct_list: variant_is_correct_list
        },
        success: function (data) {
            $('.ajax-loader').fadeOut();

            if(data.status == false){
                showError(data.error);
                return;
            }

            $(ob).closest('.question_item').find('.test_teacher_question_id').val(data.test_teacher_question_id);
            showMessage('Успешно добавлено');
        }
    });
}

function deleteTestTeacherQuestionVariant(ob) {
    $(ob).closest('.variant_item').remove();
}

function deleteTestTeacherQuestion(ob){
    if(confirm('Действительно хотите удалить?')){
        if($(ob).closest('.question_item').find('.test_teacher_question_id').val() == ''){
            $(ob).closest('.question_item').remove();
            return;
        }

        $('.ajax-loader').fadeIn();
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/admin/test-teacher/question',
            data: {
                test_teacher_question_id: $(ob).closest('.question_item').find('.test_teacher_question_id').val()
            },
            success: function(data){
                $('.ajax-loader').fadeOut();
                if(data.status == false){
                    showError(data.error);
                    return;
                }

                $(ob).closest('.question_item').remove();
            }
        });
    }
}

$('.select2').select2();
$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();