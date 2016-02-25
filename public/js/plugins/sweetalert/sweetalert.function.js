function swalert(title, text, type, func) {
    switch (type) {
        case 'info':
            swal({title: title, text: text});
            break;
        case 'success':
            swal({title: title, text: text, type: type});
            break;
        case 'warning':
            swal({
                title: title,
                text: text,
                type: type,
                showCancelButton: true,
                confirmButtonColor: "#ec4758",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false
            }, func);
            break;
    }
}