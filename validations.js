function check_v_mail(email)
{
    email_value = document.getElementById(email).value;
    email_valid = 0;
    if (email_value.indexOf('@') >= 1) {
        email_valid_dom = email_value.substr(email_value.indexOf('@')+1);
        if (email_valid_dom.indexOf('@') == -1) {
            if (email_valid_dom.indexOf('.') >= 1) {
                email_valid_dom_e = email_valid_dom.substr(email_valid_dom.indexOf('.')+1);
                if (email_valid_dom_e.length >= 1) {
                    email_valid = 1;
                }
            }
        }
    }
    if (email_valid) {
        email_valid_r = 1;
        update_css_class(field, 2);
    } else {
        email_valid_r = 0;
        update_css_class(field, 1);
    }
    return email_valid_r;
}

function update_css_class(field, class_index) {
    if (class_index == 1) {
        class_s = 'wrong';
    } else if (class_index == 2) {
        class_s = 'correct';
    }
    document.getElementById(field).className = class_s;
    return 1;
}

function valid_length(field) {
    fd_length = document.getElementById(field).value.length;
    if (fd_length >= 1 && fd_length <= document.getElementById(field).maxLength) {
        update_css_class(field, 2);
        ret_len = 1;
    } else {
        update_css_class(field, 1);
        ret_len = 0;
    }
    return ret_len;
}

function validate_all(output) {
    t1 = valid_length('firstname');
    t2 = valid_length('lastname');
    t3 = check_v_mail('email');
    

    errorlist = '';
    if (! t1) {
        errorlist += 'First name is too short/long<br />';
    }
    if (! t2) {
        errorlist += 'Last name is too short/long<br />';
    }
    if (! t3) {
        errorlist += 'Email is not valid, enter valid email<br />';
    }
    if (errorlist) {
        document.getElementById(output).innerHTML = errorlist;
        return false;
    }
    return true;
}
