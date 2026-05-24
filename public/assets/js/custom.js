
  // Turn all file input elements into ponds
    // Plugin register
    FilePond.registerPlugin(FilePondPluginImagePreview);

    FilePond.create(document.querySelector('.filepond'), {
        allowMultiple: false,
        acceptedFileTypes: ['image/*'],
        labelIdle: `
            <div style="font-size:14px; color:#555;">
                <strong>Drag & Drop</strong> your photo or <span class="filepond--label-action">Browse</span>
            </div>`,
        imagePreviewHeight: 250, 
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'center bottom',
        styleButtonRemoveItemPosition: 'right top',
        styleButtonProcessItemPosition: 'right bottom',
        storeAsFile: true,
    });