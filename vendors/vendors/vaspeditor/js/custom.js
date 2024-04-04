function toggleMode(mode) {
    var visualEditor = document.getElementById('initial-textarea');
    var codeEditor = document.getElementById('code-editor');
    var placeholder = document.querySelector('.placeholder');

    if (mode === 'visual') {
        visualEditor.style.display = 'block';
        codeEditor.style.display = 'none';
        placeholder.style.display = visualEditor.innerHTML.trim() ? 'none' : 'block';
        // Update visual editor content with code editor content
        visualEditor.innerHTML = codeEditor.value;
    } else if (mode === 'code') {
        visualEditor.style.display = 'none';
        codeEditor.style.display = 'block';
        placeholder.style.display = 'none';
        // Update code editor content with visual editor content
        codeEditor.value = visualEditor.innerHTML;
    }
}

function execCmd(command, value = null) {
    if (value === null) {
        document.execCommand(command, false, null);
    } else {
        document.execCommand(command, false, value);
    }
}

function switchToRichTextEditor() {
    var visualEditor = document.getElementById('initial-textarea');
    var controls = document.querySelector('.controls');
    var placeholder = document.querySelector('.placeholder');

    // Show controls
    controls.style.display = 'block';

    // Hide code editor
    document.getElementById('code-editor').style.display = 'none';

    // Hide placeholder if content exists
    placeholder.style.display = visualEditor.innerHTML.trim() ? 'none' : 'block';
}