import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// 画像選択時にレビュー画面に反映
function main() {
    const input = document.querySelector('#input')
    const figure = document.querySelector('#figure')
    const figureImage = document.querySelector('#figureImage')

    input.addEventListener('change', (event) => { // <1>
        const [file] = event.target.files

        if (file) {
            figureImage.setAttribute('src', URL.createObjectURL(file))
            figure.style.display = 'block'
        } else {
            figure.style.display = 'none'
        }
    })
}

main()


// ---------------------------
// ▼A：対象要素を得る
// ---------------------------
var tabs = document.getElementById('tabcontrol').getElementsByTagName('a');
var pages = document.getElementById('tabbody').getElementsByTagName('div');

// ---------------------------
// ▼B：タブの切り替え処理
// ---------------------------
function changeTab() {
    // ▼B-1. href属性値から対象のid名を抜き出す
    var targetid = this.href.substring(this.href.indexOf('#') + 1, this.href.length);

    // ▼B-2. 指定のタブページだけを表示する
    for (var i = 0; i < pages.length; i++) {
        if (pages[i].id != targetid) {
            pages[i].style.display = "none";
        }
        else {
            pages[i].style.display = "block";
        }
    }

    // ▼B-3. クリックされたタブを前面に表示する
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].style.zIndex = "0";
    }
    this.style.zIndex = "10";

    // ▼B-4. ページ遷移しないようにfalseを返す
    return false;
}

// ---------------------------
// ▼C：すべてのタブに対して、クリック時にchangeTab関数が実行されるよう指定する
// ---------------------------
for (var i = 0; i < tabs.length; i++) {
    tabs[i].onclick = changeTab;
}

// ---------------------------
// ▼D：最初は先頭のタブを選択しておく
// ---------------------------
tabs[0].onclick()