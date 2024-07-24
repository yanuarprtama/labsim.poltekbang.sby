export function containsOnlyDigits(str) {
    return /^\d+$/.test(str);
}

export function startLessThanEnd(start, end) {
    return (start >= end) ? "Jam mulai lebih dari jam akhir" : ""
}

export function isEmpty(str) {
    return str.trim() === "" || isValidSelectInput(str)
}

export function isValidTime(time) {
    const timeRegex = /^(?:[01]\d|2[0-3]):[0-5]\d\s?(AM|PM)$/i;
    return timeRegex.test(time);
}

export function isValidateInputTime(str) {
    if (isEmpty(str)) {
        return "mohon diisi !"
    } else if (isValidTime(str)) {
        return "waktu tidak valid"
    } else {
        return ""
    }
}

export function isValidateInput(str) {
    console.log(isEmpty(str), str);
    if (isEmpty(str)) {
        return "mohon diisi !"
    } else {
        return ""
    }
}

function isValidSelectInput(str) {
    return /^([\-]{2})\s*?([\s\w]+)\s*?([\-]{2})?$/i.test(str)
}

export function isValidateInputEnum(enumString, str) {
    let result = false;
    if (isEmpty(str)) {
        return "Mohon diisi !"
    } else {
        enumString.forEach((element) => {
            if (element == str) {
                result = true
            }
        });
        return result ? "" : "isi tidak valid !";
    }
}