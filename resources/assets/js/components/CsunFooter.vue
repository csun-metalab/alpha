<template>
    <footer class="footer">
        <div class="container">
            <div class="row">
            <!-- Footer CSUN Seal -->
                <div class="col-sm-2 col-md-2 col-lg-1 offset-1 offset-md-0 text-center footer-seal">
                    <img src="//www.csun.edu/sites/default/themes/csun/images/footer-seal.png" alt="Seal for California State University, Northridge">
                </div>
            <!-- CSUN address/contact -->
                <div class="col-sm-8 col-md-5 col-lg-4">
                    <ul class="list-unstyled offset-2 offset-md-0">
                        <li><strong>{{ this.appName }}</strong> <br>© California State University, Northridge</li>
                        <li>18111 Nordhoff Street, Northridge, CA 91330</li>
                        <li>Phone: (818) 677-1200 / <a href="//www.csun.edu/contact/" target="_blank">Contact Us</a></li>
                    </ul>
                </div>
            <!-- Footer links -->
                    <!-- Link set 1 -->
                        <div class="col-12 col-sm-4 col-md-2 col-lg-2">
                            <ul class="list-unstyled offset-2 offset-md-0">
                                <li><a href="//www.csun.edu/emergency/" target="_blank">Emergency Information</a></li>
                                <li><a href="//www.csun.edu/afvp/university-policies-procedures/" target="_blank">University Policies &amp; Procedures</a></li>
                            </ul>
                        </div>
                    <!-- Link set 2 -->
                        <div class="col-12 col-sm-4 col-md-2 col-lg-3">
                            <ul class="list-unstyled offset-2 offset-md-0">
                                <li><a href="//www.csun.edu/sites/default/files/900-12.pdf" target="_blank">Terms and Conditions for Use</a></li>
                                <li><a href="//www.csun.edu/sites/default/files/500-8025.pdf" target="_blank">Privacy Policy</a></li>
                                <li><a href="//www.csun.edu/it/document-viewers" target="_blank">Document Reader</a></li>
                            </ul>
                        </div>
                    <!-- Link set 3 -->
                        <div class="col-12 col-sm-4 col-md-1 col-lg-2">
                            <ul class="list-unstyled offset-2 offset-md-0">
                                <li><a href="//www.calstate.edu/" target="_blank">California State University</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
    </footer>
</template>

<script>
export default {
    props: ['app-name'],
};
</script>
