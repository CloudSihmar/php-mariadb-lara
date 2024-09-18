<div x-data="{ value: @entangle($attributes->wire('model')) }" x-init="tinymce.init({
    target: $refs.tinymce,
    themes: 'modern',
    height: 200,
    menubar: false,
    branding:false,
    plugins: ['link image code'],
    toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code',
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    setup: function(editor) {
        editor.on('blur', function(e) {
            value = editor.getContent()
        })

        editor.on('init', function(e) {
            if (value != null) {
                editor.setContent(value)
            }
        })

        function putCursorToEnd() {
            editor.selection.select(editor.getBody(), true);
            editor.selection.collapse(false);
        }

        $watch('value', function(newValue) {
            if (newValue !== editor.getContent()) {
                editor.resetContent(newValue || '');
                putCursorToEnd();
            }
        });
    }
})" wire:ignore>
    <div>
        <input x-ref="tinymce" type="textarea" {{ $attributes->whereDoesntStartWith('wire:model') }}>
    </div>
</div>