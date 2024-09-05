<script>
    function toggleAnswers() {
        const div = document.getElementById("hidden");
        if (div.style.display === "none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
</script>
<x-nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="quiz-wrapper" class="bg-gray-500 p-2 ml-2">
                    <h2 class="text-lg mb-5"><strong>The results!</strong></h2>

                    Amount of correct answers: <?= $data["correct"]; ?><br>
                    <?php
                    // var_dump($data[0]["question"]);
                    ?>
                    <a href="/"><button class="bg-green-500 rounded-md p-2 mt-4 mr-2 text-white">Return to home</button></a>
                    <a href="/quiz/display/take"><button class="bg-yellow-500 rounded-md p-2 mt-4 mr-2 text-white">Take the quiz again</button></a>
                    <button onclick="toggleAnswers()" class="bg-red-500 rounded-md p-2 mt-4 mr-2 text-white">See the answers</button></a>


                    <div id="hidden" class="text-white" style="display: none;">
                        <?php
                        for ($i=0; $i < count($data) - 1; $i++) {
                            if ($data[$i]["question"] === $data[$i]["answer"]) {
                                $color = "green";
                            } else {$color = "red";}
                            echo "<div class='bg-$color-500'>";
                            echo "our answer:<br>  ";
                            echo $data[$i]["question"];
                            echo "<br>your answer:<br>  ";
                            echo $data[$i]["answer"];
                            echo "<br><br></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-nav>
