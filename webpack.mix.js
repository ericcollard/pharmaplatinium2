const mix = require("laravel-mix");
const lodash = require("lodash");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

const folder = {
    src: "resources/", // source files
    dist: "public/", // build files
    dist_assets: "public/assets/", //build assets files
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//
mix.options({
    uglify: {
        uglifyOptions: {
            mangle: {
                keep_fnames: true,
            },
        },
    },
});
//

var assets = {
    js: [
        "./node_modules/jquery/dist/jquery.js",
        "./node_modules/bootstrap/dist/js/bootstrap.bundle.js",
        "./node_modules/moment/moment.js",
        "./node_modules/simplebar/dist/simplebar.min.js",
        "./node_modules/daterangepicker/daterangepicker.js",
        "./node_modules/jquery-toast-plugin/dist/jquery.toast.min.js",
        "./node_modules/select2/dist/js/select2.min.js",
        "./node_modules/jquery-mask-plugin/dist/jquery.mask.min.js",
        "./node_modules/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js",
        "./node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
        "./node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js",
        "./node_modules/bootstrap-maxlength/dist/bootstrap-maxlength.min.js",
        "./node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
        "./node_modules/highlightjs/highlight.pack.min.js",
    ],
};

//copying required assets
lodash(assets).forEach(function (asset, type) {
    var js = [];
    for (let i = 0; i < asset.length; ++i) {
        js.push(asset[i]);
    }
    mix.combine(js, folder.dist_assets + "js/vendor.js").minify(
        folder.dist_assets + "js/vendor.js"
    );
});

// optional third party assets
var third_party_assets = {
    css_js: [
        {
            name: "chartjs",
            assets: ["./node_modules/chart.js/dist/Chart.bundle.min.js"],
        },

        { name: "d3", assets: ["./node_modules/d3/dist/d3.min.js"] },
        {
            name: "britecharts",
            assets: [
                "./node_modules/britecharts/dist/bundled/britecharts.min.js",
                "./node_modules/britecharts/dist/css/britecharts.min.css",
            ],
        },
        {
            name: "datatables",
            assets: [
                "./node_modules/datatables.net/js/jquery.dataTables.min.js",
                "./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js",
                "./node_modules/datatables.net-responsive/js/dataTables.responsive.min.js",
                "./node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js",
                "./node_modules/datatables.net-buttons/js/dataTables.buttons.min.js",
                "./node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.html5.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.flash.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.print.min.js",
                "./node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js",
                "./node_modules/datatables.net-select/js/dataTables.select.min.js",
                "./node_modules/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js",

                "./node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css",
                "./node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css",
                "./node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css",
                "./node_modules/datatables.net-select-bs4/css/select.bootstrap4.css",
            ],
        },
        {
            name: "jquery-datatables-checkboxes",
            assets: [
                "./node_modules/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js",
            ],
        },

        {
            name: "jquery-ui",
            assets: ["./node_modules/jquery-ui/jquery-ui.min.js"],
        },

        {
            name: "fullcalendar",
            assets: [
                "./node_modules/fullcalendar/main.min.js",
                "./node_modules/fullcalendar/main.min.css",
            ],
        },

        { name: "gmaps", assets: ["./node_modules/gmaps/gmaps.min.js"] },

        {
            name: "admin-resources",
            assets: [
                "./node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-au-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-il-chicago-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-in-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-uk-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-ca-lcc-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-europe-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-fr-merc-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-es-merc.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-es-mill.js",

                "./node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css",
            ],
        },

        {
            name: "dragula",
            assets: ["./node_modules/dragula/dist/dragula.min.js"],
        },

        {
            name: "dropzone",
            assets: ["./node_modules/dropzone/dist/min/dropzone.min.js"],
        },

        {
            name: "apexcharts",
            assets: ["./node_modules/apexcharts/dist/apexcharts.min.js"],
        },

        {
            name: "quill",
            assets: [
                "./node_modules/quill/dist/quill.min.js",

                "./node_modules/quill/dist/quill.core.css",
                "./node_modules/quill/dist/quill.bubble.css",
                "./node_modules/quill/dist/quill.snow.css",
            ],
        },


        {
            name: "simplemde",
            assets: [
                "./node_modules/simplemde/dist/simplemde.min.js",
                "./node_modules/simplemde/dist/simplemde.min.css",
            ],
        },

        {
            name: "typeahead",
            assets: [
                "./node_modules/typeahead.js/dist/typeahead.bundle.min.js",
            ],
        },

        {
            name: "handlebars",
            assets: ["./node_modules/handlebars/dist/handlebars.min.js"],
        },

        {
            name: "jquery-sparkline",
            assets: ["./node_modules/jquery-sparkline/jquery.sparkline.min.js"],
        },

        {
            name: "ion-rangeslider",
            assets: [
                "./node_modules/ion-rangeslider/js/ion.rangeSlider.min.js",
            ],
        },

        {
            name: "frappe-gantt",
            assets: [
                "./node_modules/frappe-gantt/dist/frappe-gantt.min.js",
                "./node_modules/frappe-gantt/dist/frappe-gantt.css",
            ],
        },
        {
            name: "fullcalendar.min.js",
            assets: [
                "./node_modules/fullcalendar/main.min.js",
                "./node_modules/fullcalendar/main.min.css",
            ],
        },
        {
            name: "jquery-rateit",
            assets: [
                "./node_modules/jquery.rateit/scripts/jquery.rateit.min.js",
            ],
        },
    ],
};

//copying third party assets
lodash(third_party_assets).forEach(function (assets, type) {
    if (type == "css_js") {
        lodash(assets).forEach(function (plugin) {
            var name = plugin["name"],
                assetlist = plugin["assets"],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset) {
                var ass = asset.split(",");
                for (let i = 0; i < ass.length; ++i) {
                    if (ass[i].substr(ass[i].length - 3) == ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                }
            });
            if (js.length > 0) {
                mix.combine(
                    js,
                    folder.dist_assets +
                        "/libs/" +
                        name +
                        "/" +
                        name +
                        ".min.js"
                );
            }
            if (css.length > 0) {
                mix.combine(
                    css,
                    folder.dist_assets +
                        "/libs/" +
                        name +
                        "/" +
                        name +
                        ".min.css"
                );
            }
        });
    }
});

mix.copyDirectory('vendor/tinymce/tinymce', folder.dist_assets + 'js/tinymce');

// copy all fonts -
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts/", out);

// copy all images -
out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images/", out);

// scss
mix.sass(
    folder.src + "/scss/app-creative-dark.scss",
    folder.dist_assets + "css"
).minify(folder.dist_assets + "css/app-creative-dark.css");
mix.sass(
    folder.src + "/scss/app-creative.scss",
    folder.dist_assets + "css"
).minify(folder.dist_assets + "css/app-creative.css");
mix.sass(folder.src + "/scss/app-dark.scss", folder.dist_assets + "css").minify(
    folder.dist_assets + "css/app-dark.css"
);
mix.sass(
    folder.src + "/scss/app-modern-dark.scss",
    folder.dist_assets + "css"
).minify(folder.dist_assets + "css/app-modern-dark.css");
mix.sass(
    folder.src + "/scss/app-modern.scss",
    folder.dist_assets + "css"
).minify(folder.dist_assets + "css/app-modern.css");
mix.sass(folder.src + "/scss/app.scss", folder.dist_assets + "css").minify(
    folder.dist_assets + "css/app.css"
);
mix.sass(folder.src + "/scss/icons.scss", folder.dist_assets + "css").minify(
    folder.dist_assets + "css/icons.css"
);

//copying demo pages related assets
var app_pages_assets = {
    js: [
        folder.src + "js/pages/demo.dashboard.js",
        folder.src + "js/pages/demo.dashboard-crm.js",
        folder.src + "js/pages/demo.dashboard-projects.js",
        folder.src + "js/pages/demo.dashboard-analytics.js",
        folder.src + "js/pages/demo.britechart.js",
        folder.src + "js/pages/demo.calendar.js",
        folder.src + "js/pages/demo.chartjs.js",
        folder.src + "js/pages/demo.datatable-init.js",
        folder.src + "js/pages/demo.form-wizard.js",
        folder.src + "js/pages/demo.google-maps.js",
        folder.src + "js/pages/demo.vector-maps.js",
        folder.src + "js/pages/demo.profile.js",
        folder.src + "js/pages/demo.toastr.js",
        folder.src + "js/pages/demo.project-detail.js",
        folder.src + "js/pages/demo.apex-line.js",
        folder.src + "js/pages/demo.apex-area.js",
        folder.src + "js/pages/demo.apex-column.js",
        folder.src + "js/pages/demo.apex-bar.js",
        folder.src + "js/pages/demo.apex-mixed.js",
        folder.src + "js/pages/demo.apex-bubble.js",
        folder.src + "js/pages/demo.apex-candlestick.js",
        folder.src + "js/pages/demo.apex-scatter.js",
        folder.src + "js/pages/demo.apex-pie.js",
        folder.src + "js/pages/demo.apex-radialbar.js",
        folder.src + "js/pages/demo.apex-heatmap.js",
        folder.src + "js/pages/demo.apex-sparklines.js",
        folder.src + "js/pages/demo.apex-radar.js",
        folder.src + "js/pages/demo.simplemde.js",
        folder.src + "js/pages/demo.products.js",
        folder.src + "js/pages/demo.customers.js",
        folder.src + "js/pages/demo.sellers.js",
        folder.src + "js/pages/demo.widgets.js",
        folder.src + "js/pages/demo.typehead.js",
        folder.src + "js/pages/demo.sparkline.js",
        folder.src + "js/pages/demo.tasks.js",
        folder.src + "js/pages/demo.timepicker.js",
        folder.src + "js/pages/demo.inbox.js",
        folder.src + "js/pages/demo.project-gantt.js",
        folder.src + "js/pages/demo.materialdesignicons.js",
        folder.src + "js/pages/demo.quilljs.js",
    ],
};

var out = folder.dist_assets + "js/";
lodash(app_pages_assets).forEach(function (assets, type) {
    for (let i = 0; i < assets.length; ++i) {
        mix.js(assets[i], out + "pages");
    }
});

//copying optional components
var componentsAssets = {
    js: [
        folder.src + "js/ui/component.dragula.js",
        folder.src + "js/ui/component.fileupload.js",
        folder.src + "js/ui/component.chat.js",
        folder.src + "js/ui/component.todo.js",
        folder.src + "js/ui/component.range-slider.js",
        folder.src + "js/ui/component.rating.js",
        folder.src + "js/ui/component.scrollbar.js",
    ],
};

var out = folder.dist_assets + "js/";
lodash(componentsAssets).forEach(function (assets, type) {
    for (let i = 0; i < assets.length; ++i) {
        mix.js(assets[i], out + "ui");
    }
});

mix.combine(
    [folder.src + "js/layout.js", folder.src + "js/hyper.js"],
    folder.dist_assets + "js/app.min.js"
);

mix.webpackConfig({
    plugins: [
        new BrowserSyncPlugin({
            files: [
                "app/**/*",
                "public/**/*",
                "resources/views/**/*",
                "routes/**/*",
            ],
        }),
    ],
});
