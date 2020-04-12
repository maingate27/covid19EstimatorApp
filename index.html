<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="COVID-19 Infections Estimator">
    <meta name="author" content="muktar ">

    <title>COVID-19 Infections Estimator</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div class="py-5 text-center">
          <h2>COVID-19 Infections Estimator</h2>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2 p-5 main-shadow">
                <form class="needs-validation" autocomplete="off" onsubmit="getEstimation();return false;" data-estimation-form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="periodType">Period Type</label>
                            <select class="custom-select d-block w-100" id="periodType" data-period-type required>
                                <option value="">Choose...</option>
                                <option value="days">Days</option>
                                <option value="weeks">Weeks</option>
                                <option value="months">Months</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid period type.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="timeToElapse">Time To Elapse</label>
                            <input type="number" class="form-control" data-time-to-elapse id="timeToElapse" placeholder="Time To Elapse" required>
                            <div class="invalid-feedback">
                                Valid time to elapse value is required.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="reportedCases">Reported Cases</label>
                                <input type="number" class="form-control" data-reported-cases id="reportedCases" placeholder="Reported Cases" required>
                                <div class="invalid-feedback">
                                    Valid reported cases value is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="population">Population</label>
                                <input type="number" class="form-control" data-population id="population" placeholder="Population" required>
                                <div class="invalid-feedback">
                                    Valid population value is required.
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="totalHospitalBeds">Total Hospital Beds</label>
                                <input type="number" class="form-control" data-total-hospital-beds id="totalHospitalBeds" placeholder="Total Hospital Beds" required>
                                <div class="invalid-feedback">
                                    Valid total hospital beds value is required.
                                </div>
                            </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-dark btn-lg" data-go-estimate type="submit">Get Estimation</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
          <p class="mb-1">&copy; 2020 COVID-19 Infections Estimator</p>
        </footer>
    </div>

    <script type="text/javascript">
        function getEstimation() {
            var population = document.querySelector('[data-population]').value;
            var timeToElapse = document.querySelector('[data-time-to-elapse]').value;
            var reportedCases = document.querySelector('[data-reported-cases]').value;
            var totalHospitalBeds = document.querySelector('[data-total-hospital-beds]').value;
            var periodType = document.querySelector('[data-period-type]').value;
            var apiUrl = 'api/v1/on-covid-19/json';
            var submitBtn = document.querySelector('[data-go-estimate]');

            var data = JSON.stringify({
                    region: {
                        name: 'Africa',
                        avgAge: 19.7,
                        avgDailyIncomeInUSD: 2,
                        avgDailyIncomePopulation: 0.66
                    },
                    periodType: periodType,
                    timeToElapse: timeToElapse,
                    reportedCases: reportedCases,
                    population: population,
                    totalHospitalBeds: totalHospitalBeds
                });

            submitBtn.classList.add('disabled');
            submitBtn.setAttribute('disabled', true);
            submitBtn.innerHTML = "Please wait...";

            fetch(apiUrl, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                submitBtn.classList.remove('disabled');
                submitBtn.removeAttribute('disabled');
                submitBtn.innerHTML = "Get Estimation";

                // console.log(data);
            });
        }
    </script>
</body>
</html>
