@once
    @push('scripts')
        <script>
            function mopsConfirmAction()
            {
                return {
                    confirm(prompt, method, params = []) {
                        if (confirm(prompt)) {
                            this.$wire.call(method, params);
                        }
                    }
                }
            }
        </script>
    @endpush
@endonce
