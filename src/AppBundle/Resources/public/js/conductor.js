function limit(element)
{
    var max_chars = 1;

    if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}