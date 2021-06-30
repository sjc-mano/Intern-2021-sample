"use strict";
$(function () {

    const url = $(location).attr('href');
    const userId = $("#js-userid");
    const errorUserId = $("#js-error-userid");
    const userPassword = $("#js-userpassword");
    const errorUserPassword = $("#js-error-userpassword");
    const userName = $("#js-username");
    const errorUserName = $("#js-error-username");
    const mailaddress = $("#js-mailaddress");
    const errorMailaddress = $("#js-error-mailaddress");
    const saveButton = $("#js-usersave");
    const deleteButton = $("#js-userdelete");
    let errorCountUserId = "0";
    let errorCountUserPassword = "0";
    let errorCountUserName = "0";
    let errorCountMailaddress = "0";

    function saveButtonSwitch() {
        if (errorCountUserId === "0" && errorCountUserPassword === "0" && errorCountUserName === "0" && errorCountMailaddress === "0") {
            saveButton.css("display", "block");
        }
        else {
            saveButton.hide();
        }
    }

    userId.on("blur", () => {
        if (userId.val() == "") {
            errorUserId.css("display", "block");
            errorUserId.text("ユーザIDを入力してください。");
            errorCountUserId = "1";
        }
        else if (!userId.val().match(/^[0-9a-zA-Z]*$/)) {
            errorUserId.css("display", "block");
            errorUserId.text("半角英数字を入力してください。");
            errorCountUserId = "1";
        }
        else {
            errorUserId.hide();
            errorCountUserId = "0";
        }
        saveButtonSwitch();
    });

    userPassword.on("focus", () => {
        if (userPassword.val() == "●●●●") {
            userPassword.val("");
        }
    });

    userPassword.on("blur", () => {
        if (userPassword.val() == "") {
            userPassword.val("●●●●");
        }
        else if (!userPassword.val().match(/^[0-9a-zA-Z]*$/)) {
            errorUserPassword.css("display", "block");
            errorUserPassword.text("半角英数字を入力してください。");
            errorCountUserPassword = "1";
        }
        else {
            errorUserPassword.hide();
            errorCountUserPassword = "0";
        }
        saveButtonSwitch()
    });

    userName.on("blur", () => {
        if (userName.val() == "") {
            errorUserName.css("display", "block");
            errorUserName.text("ユーザ名を入力してください。");
            errorCountUserName = "1";
        }
        else {
            errorUserName.hide();
            errorCountUserName = "0";
        }
        saveButtonSwitch()
    });

    mailaddress.on("blur", () => {
        if (!mailaddress.val() == "") {
            if (!mailaddress.val().match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                errorMailaddress.css("display", "block");
                errorMailaddress.text("メールアドレスの形式が正しくありません。");
                errorCountMailaddress = "1";
            }
            else {
                errorMailaddress.hide();
                errorCountMailaddress = "0";
            }
        } else {
            errorMailaddress.hide();
            errorCountMailaddress = "0";
        }
        saveButtonSwitch()
    });

    saveButton.on("click", () => {
        if (userId.val() == "") {
            errorUserId.css("display", "block");
            errorUserId.text("ユーザIDを入力してください。");
            errorCountUserId = "1";
        }
        if (userPassword.val() == "") {
            errorUserPassword.css("display", "block");
            errorUserPassword.text("パスワードを入力してください。");
            errorCountUserPassword = "1";
        }
        if (userName.val() == "") {
            errorUserName.css("display", "block");
            errorUserName.text("ユーザ名を入力してください。");
            errorCountUserName = "1";
        }
        if (errorCountUserId == "1" || errorCountUserPassword == "1" || errorCountUserName == "1") {
            saveButton.hide();
        }

        else if (errorCountUserId == "0" && errorCountUserPassword == "0" && errorCountUserName == "0" && errorCountMailaddress == "0") {
            var result = window.confirm("編集を保存しますか？");

            if (result) {
                const form = $('#update-form').serialize();
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
                if (url.match(/\/users\/create/)) {
                    // 新規登録の場合
                    $.ajax({
                        type: 'POST',
                        url: submitUrl,
                        data: form,
                        dataType: 'json',
                        timeout: 15000,
                        beforeSend: () => {
                            $("#overlay").fadeIn(300); // Lading 画像を表示
                        }
                    }).done((response) => {
                        let message = response.message;
                        alert(message);
                        window.location.href = editUrl.replace('@', userId.val()); // 登録したユーザの編集画面へ移動
                    }).fail((response) => {
                        // サーバからエラー内容を取得してエラー内容ごとにメッセージを設定
                        if (response.status == 422) {
                            let errors = response.responseJSON.errors;
                            validationErrorDisplay(errors);
                        }
                        console.log(response);
                        let message = response.responseJSON.message;
                        alert(message);
                    }).always((data) => {
                        $("#overlay").fadeOut(300); // Lading 画像を消す
                    });
                }
                else if (url.match(/\/users\/[\S]+\/edit/)) {
                    // 編集の場合
                    $.ajax({
                        type: 'PATCH',
                        url: submitUrl,
                        data: form,
                        dataType: 'json',
                        timeout: 15000,
                        beforeSend: () => {
                            $("#overlay").fadeIn(300); // Lading 画像を表示
                        }
                    }).done((response) => {
                        let message = response.message;
                        alert(message);
                        window.location.reload(); // ページの更新
                    }).fail((response) => {
                        // サーバからエラー内容を取得してエラー内容ごとにメッセージを設定
                        if (response.status == 422) {
                            let errors = response.responseJSON.errors;
                            validationErrorDisplay(errors);
                        }

                        let message = response.responseJSON.message;
                        alert(message);
                    }).always((data) => {
                        $("#overlay").fadeOut(300); // Lading 画像を消す
                    });
                }
            }
        }
    });

    deleteButton.on("click", () => {
        var result = window.confirm("ユーザID（" + userId.val() + "）を削除しますか？");

        if (result) {
            $('#delete-form').submit();
        }
    });

    function validationErrorDisplay(message) {
        if (message.user_id) {
            errorUserId.css("display", "block");
            errorUserId.text(message.user_id[0]);
            errorCountUserId = "1";
        }

        if (message.user_pass) {
            errorUserPassword.css("display", "block");
            errorUserPassword.text(message.user_pass[0]);
            errorCountUserPassword = "1";
        }

        if (message.user_name) {
            errorUserName.css("display", "block");
            errorUserName.text(message.user_name[0]);
            errorCountUserName = "1";
        }

        if (message.mail_address) {
            errorMailaddress.css("display", "block");
            errorMailaddress.text(message.mail_address[0]);
            errorCountMailaddress = "1";
        }

        saveButton.hide();
    }
});
