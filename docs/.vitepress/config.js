export default {
    title: "Laravel Multi Payment Gateway",
    description: "Documentation for integrating the Laravel Multi Payment Gateway Package",

    head: [
      ['link', { rel: 'icon', href: '/icon.ico' }],
      ['link', { rel: 'stylesheet', href: '../theme/custom.css' }]
    ],

    themeConfig: {
      logo: "/logo.png",
      siteTitle: "Laravel Multi Payment Gateway",

      // Navbar Link

      nav: [
        { text: "Home", link: "/index.html" },
        { text: "Installation", link: "/getting-started/installation.html" },
        {
          text: "API Documentation",
          items: [
            { text: "Stripe", link: "https://docs.terminal.africa/tship/?utm_source=null" },
            { text: "Paystack", link: "/other-apis.html" },
            { text: "Flutterwave", link: "/other-apis.html" },
          ]
        },
        { text: "Github", link: "https://github.com/MusahMusah/laravel-multipayment-gateways" }
      ],

      // Sidebar
      sidebar: [
        {
          text: "INTRODUCTION",
          collapsible: true,
          items: [
            { text: "Installation", link: "/getting-started/installation.html" },
          ],
        },

        {
            text: "STRIPE",
            collapsible: true,
            items: [
                { text: "Installation", link: "/stripe/installation.html"},
            ],
        },

        {
            text: "PAYSTACK",
            collapsible: true,
            items: [
                { text: "Installation", link: "/paystack/installation.html"}
            ],
        },

        {
            text: "FLUTTERWAVE",
            collapsible: true,
            items: [
                { text: "Installation", link: "/flutterwave/installation.html"}
            ],
        },

        {
            text: "WEBHOOKS",
            collapsible: true,
            items: [
                { text: "Installation", link: "/webhook/installation.html"},
            ],
        },

      ],

    //   define a custom link resolver function
      linkResolver: (page, pages) => {
          // find the index of the current page in the pages array
          const currentPageIndex = pages.findIndex(p => p.path === page.path)

          // find the next page based on the order of the items in the sidebar
          for (let i = 0; i < sidebar.length; i++) {
            const item = sidebar[i]
            for (let j = 0; j < item.items.length; j++) {
              const nextItem = item.items[j]
              if (nextItem.link && nextItem.link.startsWith("/") && nextItem.link !== page.path) {
                const nextPage = pages.find(p => p.path === nextItem.link)
                const nextPageIndex = pages.findIndex(p => p.path === nextPage.path)
                if (nextPageIndex > currentPageIndex) {
                  return nextPage.path
                }
              }
            }
          }

          // if no next page is found, return null
          return null
        },

      footer: {
        message: "Released under the MIT License.",
        copyright: "Copyright © 2022-present Adocs",
      },

      markdown: {
        theme: "material-palenight",
        lineNumbers: true,
      },
    },
  };
