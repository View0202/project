<!doctype html>
<html>
    <head>
        <title>บริษัทปัญญาประดิษฐ์ รูปแบบเว็บไซต์ | WIX</title>
        <!-- BEGIN SENTRY -->
        <script id="sentry">
            (function(c, u, v, n, p, e, z, A, w) {
                function k(a) {
                    if (!x) {
                        x = !0;
                        var l = u.getElementsByTagName(v)[0]
                          , d = u.createElement(v);
                        d.src = A;
                        d.crossorigin = "anonymous";
                        d.addEventListener("load", function() {
                            try {
                                c[n] = r;
                                c[p] = t;
                                var b = c[e]
                                  , d = b.init;
                                b.init = function(a) {
                                    for (var b in a)
                                        Object.prototype.hasOwnProperty.call(a, b) && (w[b] = a[b]);
                                    d(w)
                                }
                                ;
                                B(a, b)
                            } catch (g) {
                                console.error(g)
                            }
                        });
                        l.parentNode.insertBefore(d, l)
                    }
                }
                function B(a, l) {
                    try {
                        for (var d = m.data, b = 0; b < a.length; b++)
                            if ("function" === typeof a[b])
                                a[b]();
                        var e = !1
                          , g = c.__SENTRY__;
                        "undefined" !== typeof g && g.hub && g.hub.getClient() && (e = !0);
                        g = !1;
                        for (b = 0; b < d.length; b++)
                            if (d[b].f) {
                                g = !0;
                                var f = d[b];
                                !1 === e && "init" !== f.f && l.init();
                                e = !0;
                                l[f.f].apply(l, f.a)
                            }
                        !1 === e && !1 === g && l.init();
                        var h = c[n]
                          , k = c[p];
                        for (b = 0; b < d.length; b++)
                            d[b].e && h ? h.apply(c, d[b].e) : d[b].p && k && k.apply(c, [d[b].p])
                    } catch (C) {
                        console.error(C)
                    }
                }
                for (var f = !0, y = !1, q = 0; q < document.scripts.length; q++)
                    if (-1 < document.scripts[q].src.indexOf(z)) {
                        f = "no" !== document.scripts[q].getAttribute("data-lazy");
                        break
                    }
                var x = !1
                  , h = []
                  , m = function(a) {
                    (a.e || a.p || a.f && -1 < a.f.indexOf("capture") || a.f && -1 < a.f.indexOf("showReportDialog")) && f && k(h);
                    m.data.push(a)
                };
                m.data = [];
                c[e] = c[e] || {};
                c[e].onLoad = function(a) {
                    h.push(a);
                    f && !y || k(h)
                }
                ;
                c[e].forceLoad = function() {
                    y = !0;
                    f && setTimeout(function() {
                        k(h)
                    })
                }
                ;
                "init addBreadcrumb captureMessage captureException captureEvent configureScope withScope showReportDialog".split(" ").forEach(function(a) {
                    c[e][a] = function() {
                        m({
                            f: a,
                            a: arguments
                        })
                    }
                });
                var r = c[n];
                c[n] = function(a, e, d, b, f) {
                    m({
                        e: [].slice.call(arguments)
                    });
                    r && r.apply(c, arguments)
                }
                ;
                var t = c[p];
                c[p] = function(a) {
                    m({
                        p: a.reason
                    });
                    t && t.apply(c, arguments)
                }
                ;
                f || setTimeout(function() {
                    k(h)
                })
            }
            )(window, document, "script", "onerror", "onunhandledrejection", "Sentry", "b4e7a2b423b54000ac2058644c76f718", "https://static.parastorage.com/unpkg/@sentry/browser@5.27.4/build/bundle.min.js", {
                "dsn": "https://b4e7a2b423b54000ac2058644c76f718@sentry.wixpress.com/217"
            });
        </script>
        <script type="text/javascript">
            window.Sentry.onLoad(function() {
                window.Sentry.init({
                    "release": "marketing-template-viewer@1.2177.0",
                    "environment": "production",
                    "allowUrls": undefined,
                    "denyUrls": undefined
                });
                window.Sentry.configureScope(function(scope) {
                    scope.setUser({
                        id: "null-user-id:b3feb0e1-147a-47d3-acb0-dc3c4b73542e",
                        clientId: "b3feb0e1-147a-47d3-acb0-dc3c4b73542e",
                    });
                    scope.setExtra("user.authenticated", false);
                    scope.setExtra("sessionId", "935849b6-bb54-4bf3-9827-2e352560e682");
                });
            });
        </script>
        <!-- END SENTRY -->
        <script src="https://static.parastorage.com/polyfill/v3/polyfill.min.js?features=default,es6,es7,es2017,es2018,es2019,fetch&flags=gated&unknown=polyfill"></script>
        <script>
            window.onWixFedopsLoggerLoaded = function() {
                window.fedopsLogger && window.fedopsLogger.reportAppLoadStarted('marketing-template-viewer');
            }
        </script>
        <script onload="onWixFedopsLoggerLoaded()" src="//static.parastorage.com/unpkg/@wix/fedops-logger@5.507.0/dist/statics/fedops-logger.bundle.min.js" crossorigin></script>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <link rel="icon" sizes="192x192" href="https://www.wix.com/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="https://www.wix.com/favicon.ico" type="image/x-icon"/>
        <link rel="apple-touch-icon" href="https://www.wix.com/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://static.parastorage.com/services/third-party/fonts/Helvetica/fontFace.css">
        <link rel="stylesheet" href="https://static.parastorage.com/unpkg/@wix/wix-fonts@1.14.0/madefor.min.css">
        <link rel="stylesheet" href="https://static.parastorage.com/unpkg/@wix/wix-fonts@1.14.0/madeforDisplay.min.css">
        <link rel="stylesheet" href="//static.parastorage.com/services/marketing-template-viewer/1.2177.0/app.min.css">
        <meta name="description" content="เทมเพลตนี้ให้สุนทรียภาพด้านการแสดงผลเพื่อสื่อถึงมุมมองแห่งอนาคต ดีไซน์ที่มีระดับช่วยให้ผลิตภัณฑ์ของคุณเปล่งประกาย ขณะเดียวกันแอป Wix Forms ก็เป็นเครื่องมือที่ยอดเยี่ยมสำหรับการเฟ้นหาคนเก่งมาร่วมงานกับคุณ และเชิญกลุ่มคนที่สนใจเทคโนโลยีมาสมัครรับข้อมูลอัปเดตเกี่ยวกับบริษัท คลิก &#34;แก้ไข&#34; เพื่อบังคับพวงมาลัยได้เลย">
        <meta name="author" content="Wixpress">
        <meta http-equiv="content-language" content="th"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta property="og:title" content="บริษัทปัญญาประดิษฐ์ รูปแบบเว็บไซต์ | WIX"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://th.wix.com/website-template/view/html/2898"/>
        <meta property="og:image" content="//static.wixstatic.com/media//templates/image/b4f2783ce96ff27bf8d6343aa5c08bfc5cef9c057b8ebf9461d30e44bc94d2d11644571654096.jpg"/>
        <meta content="Wix" property="og:site_name">
        <meta property="og:description" content="เทมเพลตนี้ให้สุนทรียภาพด้านการแสดงผลเพื่อสื่อถึงมุมมองแห่งอนาคต ดีไซน์ที่มีระดับช่วยให้ผลิตภัณฑ์ของคุณเปล่งประกาย ขณะเดียวกันแอป Wix Forms ก็เป็นเครื่องมือที่ยอดเยี่ยมสำหรับการเฟ้นหาคนเก่งมาร่วมงานกับคุณ และเชิญกลุ่มคนที่สนใจเทคโนโลยีมาสมัครรับข้อมูลอัปเดตเกี่ยวกับบริษัท คลิก &#34;แก้ไข&#34; เพื่อบังคับพวงมาลัยได้เลย"/>
        <meta property="fb:admins" content="731184828"/>
        <meta name="fb:app_id" content="236335823061286"/>
        <meta name="google-site-verification" content="QXhlrY-V2PWOmnGUb8no0L-fKzG48uJ5ozW0ukU7Rpo"/>
        <link rel="canonical" href="https://th.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="fr" href="https://fr.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="pt" href="https://pt.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="cs" href="https://cs.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="it" href="https://it.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="nl" href="https://nl.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="ko" href="https://ko.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="de" href="https://de.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="ru" href="https://ru.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="sv" href="https://sv.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="tr" href="https://tr.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="da" href="https://da.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="en" href="https://www.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="es" href="https://es.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="hi" href="https://hi.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="ja" href="https://ja.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="no" href="https://no.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="pl" href="https://pl.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="vi" href="https://vi.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="uk" href="https://uk.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="zh" href="https://zh.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="th" href="https://th.wix.com/website-template/view/html/2898"/>
        <link rel="alternate" hreflang="x-default" href="https://www.wix.com/website-template/view/html/2898"/>
    </head>
    <body>
        <script>
            window.onWixRecorderLoaded = function() {
                window.dispatchEvent(new Event('wixRecorderReady'));
            }
            ;
        </script>
        <script async src="//static.parastorage.com/unpkg-semver/wix-recorder/app.bundle.min.js" crossorigin onload="onWixRecorderLoaded()"></script>
        <script src="//static.parastorage.com/services/cookie-sync-service/1.347.20/embed-cidx.bundle.min.js"></script>
        <script src="//static.parastorage.com/services/tag-manager-client/1.875.0/hostTags.bundle.min.js"></script>
        <div id="root">
            <div data-hook="app">
                <div data-hook="tool-bar" class="sbWfkE">
                    <div class="Mn4893">
                        <div class="bZOLNF">
                            <a data-hook="logo" href="/" class="nHuSJZ">
                                <span class="AV8G6s">wix.com</span>
                            </a>
                        </div>
                        <div class="wKSaYa">
                            <button data-hook="desktop-view" class="is65hl sdsgLW">
                                <span class="XFdFwl">แสดงมุมมองเดสก์ท็อป</span>
                            </button>
                            <hr class="hS1yv1"/>
                            <button data-hook="mobile-view" class="fB70N2">
                                <span class="XFdFwl">แสดงมุมมองมือถือ</span>
                            </button>
                        </div>
                    </div>
                    <div class="TYXuEX">
                        <div class="RyxoSg">
                            <p data-hook="tool-bar-title" class="VaexPL">คลิกแก้ไขและสร้างเว็บไซต์ที่น่าตื่นตาตื่นใจของคุณเอง</p>
                            <a data-hook="info-view" class="bggdgE" tabindex="0" role="dialog" href="#">อ่านเพิ่มเติม</a>
                            <a class="Ydu4WK" data-hook="editor-link" href="https://manage.wix.com/edit-template/from-intro?originTemplateId=bb8c85e6-6106-4b34-8945-5f5a6a4aa5de&amp;editorSessionId=f5710687-e12e-4871-a5b8-1701082b61c0" target="_blank" tabindex="0">แก้ไขหน้าเว็บไซต์นี้</a>
                        </div>
                    </div>
                </div>
                <div data-hook="template-demo" class="CJ4D6R">
                    <div data-hook="desktop-view" class="Woz8P7">
                        <iframe data-hook="desktop-iframe" src="https://www.wix.com/templatesth/2898-ai-company" title="บริษัทปัญญาประดิษฐ์" width="100%" height="100%" class="eZTjsa"></iframe>
                    </div>
                </div>
                <div data-hook="info-pop-up" class="M05QSQ">
                    <div class="E0wHmq">
                        <button data-hook="card-close" class="eds_d0">
                            <span class="ydbrSa">ปิดป๊อปอัพแสดงข้อมูล</span>
                        </button>
                        <div class="qLnKwP">
                            <h1 data-hook="card-title" class="PHJvhr">บริษัทปัญญาประดิษฐ์ - Website Template</h1>
                            <div class="CEjC4K">
                                <h3 data-hook="card-good-for-title" class="xqspyG">ดีสำหรับ:</h3>
                                <p data-hook="card-good-for" class="gsbPc5">บริษัทสตาร์ตอัปด้านเทคโนโลยีและยานพาหนะ</p>
                            </div>
                            <div class="CEjC4K">
                                <h3 class="xqspyG">คำบรรยาย:</h3>
                                <p data-hook="card-description" class="gsbPc5">เทมเพลตนี้ให้สุนทรียภาพด้านการแสดงผลเพื่อสื่อถึงมุมมองแห่งอนาคต ดีไซน์ที่มีระดับช่วยให้ผลิตภัณฑ์ของคุณเปล่งประกาย ขณะเดียวกันแอป Wix Forms ก็เป็นเครื่องมือที่ยอดเยี่ยมสำหรับการเฟ้นหาคนเก่งมาร่วมงานกับคุณ และเชิญกลุ่มคนที่สนใจเทคโนโลยีมาสมัครรับข้อมูลอัปเดตเกี่ยวกับบริษัท คลิก &quot;แก้ไข &quot;เพื่อบังคับพวงมาลัยได้เลย</p>
                            </div>
                        </div>
                        <div class="KiqsRq">
                            <a data-hook="card-editor-url" class="XpwCp3 sKD7vO" target="_blank" href="https://manage.wix.com/edit-template/from-intro?originTemplateId=bb8c85e6-6106-4b34-8945-5f5a6a4aa5de&amp;editorSessionId=f5710687-e12e-4871-a5b8-1701082b61c0">แก้ไขเลย</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.__BASEURL__ = "https:\u002F\u002Fth.wix.com\u002Fwebsite-template\u002Fview\u002Fhtml\u002F";
            window.__INITIAL_I18N__ = {
                "locale": "th",
                "resources": {
                    "errorPage.templatesLinkText": "รูปแบบ",
                    "template.viewer.page.title": "{{- title}} รูปแบบเว็บไซต์ | WIX",
                    "template.viewer.studio.page.title": "{{- title}} Responsive Template | Wix Studio",
                    "template.viewer.studio.page.description": "This {{- title}} is ready to be customized to your exact needs. Click \"Edit Template\" and try it on any device",
                    "template_button_label": "แก้ไขเว็บไซต์",
                    "template_seeFeatures_label": "ดูคุณสมบัติทั้งหมด",
                    "template_expand_examples_text": "เหมาะสำหรับ",
                    "template_expand_header": "คุณสมบัติเกี่ยวกับรูปแบบ",
                    "template.viewer.title": "คลิกแก้ไขและสร้างเว็บไซต์ที่น่าตื่นตาตื่นใจของคุณเอง",
                    "template.viewer.edit.button": "แก้ไขหน้าเว็บไซต์นี้",
                    "template.viewer.read.more": "อ่านเพิ่มเติม",
                    "template.viewer.back": "ย้อนกลับ",
                    "template.viewer.info.edit.button": "แก้ไขเลย",
                    "template.viewer.price": "ราคา:",
                    "template.viewer.info.title": "{{- title}} - Website Template",
                    "template.viewer.info.goodFor": "ดีสำหรับ:",
                    "template.viewer.info.description": "คำบรรยาย:",
                    "template.viewer.info.desktop.only.notice": "แก้ไขเทมเพลตนี้โดยไปที่ Wix.com จากเดสก์ท็อปของคุณ ที่ที่คุณสามารถปรับแต่งรูปแบบที่สวยงามของเราอย่างไรก็ได้",
                    "template.viewer.see.all.templates": "See All Templates",
                    "template.viewer.seeAllExpressions": "See all expressions",
                    "template.viewer.goToBiggerScreen": "To start designing, go to your desktop.",
                    "template.viewer.getStarted": "Get Started",
                    "template.viewer.startNow": "Start Now",
                    "template.viewer.features": "Features",
                    "template.viewer.allFeatures": "All Features",
                    "template.viewer.expressions": "Expressions",
                    "template.viewer.tutorials": "Tutorials",
                    "template.viewer.updatesAndReleases": "Updates & Releases",
                    "template.viewer.comingSoon": "Coming soon",
                    "template.viewer.academy": "Academy",
                    "template.viewer.editTemplate": "แก้ไขเทมเพลต",
                    "template.viewer.header.backToTemplates": "กลับไปที่เทมเพลต",
                    "a11y.desktop.button": "แสดงมุมมองเดสก์ท็อป",
                    "a11y.mobile.button": "แสดงมุมมองมือถือ",
                    "a11y.close.popup.button": "ปิดป๊อปอัพแสดงข้อมูล",
                    "toolbar.tooltip.desktop": "1001px ขึ้นไป",
                    "toolbar.tooltip.tablet": "751 ถึง 1000px",
                    "toolbar.tooltip.mobile": "320 ถึง 750px",
                    "errorPage.4xx.title": "เราไม่พบเทมเพลตที่คุณกำลังค้นหา",
                    "errorPage.5xx.title": "เราไม่สามารถโหลดเทมเพลต",
                    "errorPage.subTitle": "ขัดข้อง {{- code }}",
                    "errorPage.4xx.details": "ลองค้นหาเทมเพลตอื่น ๆ \u003Clink\u003Eที่นี่\u003C\u002Flink\u003E",
                    "errorPage.5xx.details": "ทางเราพบปัญหาทางเทคนิคส่งผลให้ไม่สามารถโหลดหน้าเพจนี้ กรุณารอสักครู่แล้วลองอีกครั้ง",
                    "errorPage.5xx.action": "รีเฟรช"
                }
            };
            window.__INITIAL_STATE__ = {
                "viewMode": "desktop",
                "isInfoShown": false,
                "isEditButtonHidden": false,
                "template": {
                    "title": "บริษัทปัญญาประดิษฐ์",
                    "description": "เทมเพลตนี้ให้สุนทรียภาพด้านการแสดงผลเพื่อสื่อถึงมุมมองแห่งอนาคต ดีไซน์ที่มีระดับช่วยให้ผลิตภัณฑ์ของคุณเปล่งประกาย ขณะเดียวกันแอป Wix Forms ก็เป็นเครื่องมือที่ยอดเยี่ยมสำหรับการเฟ้นหาคนเก่งมาร่วมงานกับคุณ และเชิญกลุ่มคนที่สนใจเทคโนโลยีมาสมัครรับข้อมูลอัปเดตเกี่ยวกับบริษัท คลิก \"แก้ไข\" เพื่อบังคับพวงมาลัยได้เลย",
                    "image": "\u002Ftemplates\u002Fimage\u002Fb4f2783ce96ff27bf8d6343aa5c08bfc5cef9c057b8ebf9461d30e44bc94d2d11644571654096.jpg",
                    "id": "2898",
                    "lng": "th",
                    "price": "ฟรี",
                    "docUrl": "https:\u002F\u002Fwww.wix.com\u002Ftemplatesth\u002F2898-ai-company",
                    "editorUrl": "https:\u002F\u002Fmanage.wix.com\u002Fedit-template\u002Ffrom-intro?originTemplateId=bb8c85e6-6106-4b34-8945-5f5a6a4aa5de&editorSessionId=f5710687-e12e-4871-a5b8-1701082b61c0",
                    "goodFor": "บริษัทสตาร์ตอัปด้านเทคโนโลยีและยานพาหนะ",
                    "siteId": "50e763fb-6000-43d5-a5cf-ae4b991b8cb9",
                    "metaSiteId": "bb8c85e6-6106-4b34-8945-5f5a6a4aa5de",
                    "editorSessionId": "f5710687-e12e-4871-a5b8-1701082b61c0",
                    "isResponsive": false,
                    "isStudio": false,
                    "templateId": "41894390-c4c2-4a1c-9b5c-3b908fc4d15b",
                    "url": "https:\u002F\u002Fwww.wix.com\u002Ftemplatesth\u002F2898-ai-company"
                },
                "activeExperiments": ["OpenTemplateInSameTabForDashboardFirstUsers", "StudioTemplatesPageNewUI"],
                "config": {
                    "locale": "th",
                    "dealerCmsTranslationsUrl": "\u002F\u002Fstatic.parastorage.com\u002Fservices\u002Fdealer-cms-translations\u002F1.6834.0\u002F",
                    "dealerLightboxUrl": "\u002F\u002Fstatic.parastorage.com\u002Fservices\u002Fdealer-lightbox\u002F2.0.260\u002F"
                },
                "userData": {
                    "isLoggedIn": false
                }
            };
            window.__BI__ = {
                "siteId": "50e763fb-6000-43d5-a5cf-ae4b991b8cb9",
                "originUrl": "https:\u002F\u002Fth.wix.com\u002Fwebsite\u002Ftemplates",
                "referer": "https:\u002F\u002Fth.wix.com\u002Fwebsite\u002Ftemplates",
                "editorSessionId": "f5710687-e12e-4871-a5b8-1701082b61c0"
            };
            window.__DEVICE__ = "desktop";
            window.__CONSENT_POLICY__ = {
                "essential": true,
                "functional": true,
                "analytics": true,
                "advertising": true,
                "dataToThirdParty": true
            };
        </script>
        <script src="//static.parastorage.com/unpkg/react@18.2.0/umd/react.production.min.js" crossorigin></script>
        <script src="//static.parastorage.com/unpkg/react-dom@18.2.0/umd/react-dom.production.min.js" crossorigin></script>
        <script src="//static.parastorage.com/services/cookie-consent-policy-client/1.866.0/app.bundle.min.js"></script>
        <script src="//static.parastorage.com/services/dealer-lightbox/2.0.260/dealer-lightbox.bundle.min.js"></script>
        <script src="//static.parastorage.com/services/marketing-template-viewer/1.2177.0/app.bundle.min.js"></script>
    </body>
</html>
