interface RouteDefinition<ParameterName extends string = string> {
    // The name of the route
    // For example `articles.show`
    name: string;
    // The uri of the route
    // For example `/articles/{author}`
    uri: string;
    // An array of methods the route accepts
    methods: ReadonlyArray<
        "GET" | "HEAD" | "POST" | "PUT" | "PATCH" | "DELETE"
    >;
    // Default values for the route parameters if set
    defaults: Partial<{ [K in ParameterName]: unknown }>;
    // Regex patterns for any path parameters that should match a regex
    wheres: Partial<{ [K in ParameterName]: string }>;
    // The names of the route parameters in the url in order of appearance
    parameterNames: ReadonlyArray<ParameterName>;
    // For route model binding, if a different query key has been set.
    bindingFields: Partial<{ [K in ParameterName]: string }>;
}

interface Router {
    routes: { [key: string]: RouteDefinition };
}

const router: Router = {
    routes: {
        "articles.show": {
            name: "articles.show",
            uri: "articles/{author}/{article}/{path}",
            methods: ["PUT"],
            defaults: {
                author: "josh",
            },
            wheres: {
                path: ".*",
            },
            parameterNames: ["author", "article", "path"],
            bindingFields: {
                article: "slug",
            },
        },
    },
};

type RouteName = keyof Router["routes"];

type RouteParameters<Name extends RouteName> = {
    [K in Router["routes"][Name]["parameterNames"][number]]: unknown;
};

function route<Name extends RouteName = RouteName>(
    name: Name,
    parameters: RouteParameters<Name>,
    queryInit?:
        | string
        | string[][]
        | Record<string, string>
        | URLSearchParams
        | undefined
): string {
    const uri = `${router.routes[name].uri}`;

    if (queryInit) {
        const query = new URLSearchParams(queryInit).toString();
        return `${uri}?${query}`;
    }

    return uri;
}
