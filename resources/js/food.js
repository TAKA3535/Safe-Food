$('#dropdown').on('change', function () {
    var optionValue = $(this).val();
    var newText = '';

    // 選択されたオプションに応じて表示するテキストを決定する
    if (optionValue == 1) {
        newText = 'You selected Option 1';
    } else if (optionValue == 2) {
        newText = 'You selected Option 2';
    } else if (optionValue == 3) {
        newText = 'You selected Option 3';
    }

    // テキストを変更する
    $('#result').text(newText);
});