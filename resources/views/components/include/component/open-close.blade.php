@once
    @push('scripts')
        <script>
            function mopsComponentOpenClose() {
                return {
                    isOpen: false,

                    open(event) {
                        this.isOpen = true
                        this.onOpen(event)
                    },
                    onOpen(event) {},

                    close(event) {
                        this.isOpen = false
                        this.onClose(event);
                    },
                    onClose(event) {}
                }
            }
        </script>
    @endpush
@endonce