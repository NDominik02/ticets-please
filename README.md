"A datetime string with format `Y-m-d H:i:s`, e.g. `2018-05-23 13:43:32`."
scalar DateTime
    @scalar(class: "Nuwave\\Lighthouse\\Schema\\Types\\Scalars\\DateTime")

"Indicates what fields are available at the top level of a query operation."
type Query {
    user(
        id: ID @eq @rules(apply: ["prohibits:email", "required_without:email"])
        email: String
            @eq
            @rules(apply: ["prohibits:id", "required_without:id", "email"])
    ): User @find

    users(name: String @where(operator: "like")): [User!]!
        @paginate(defaultCount: 10)

    post(id: ID @eq): Post @find

    posts: [Post!]!
        @paginate(defaultCount: 10)
        @orderBy(column: "created_at", direction: DESC)
}

type Mutation {
    createPost(
        user_id: ID!
        title: String! @rules(apply: ["required", "min:3"])
        body: String! @rules(apply: ["required", "min:3"])
    ): Post @create

    updatePost(
        id: ID!
        title: String! @rules(apply: ["required", "min:3"])
        body: String! @rules(apply: ["required", "min:3"])
    ): Post @update

    deletePost(id: ID!): Post @delete
}

type User {
    id: ID!
    name: String!
    posts: [Post!]! @hasMany
    email: String!
    email_verified_at: DateTime
    created_at: DateTime!
    updated_at: DateTime!
}

type Post {
    id: ID!
    title: String!
    body: String!
    user: User! @belongsTo
    created_at: DateTime!
    updated_at: DateTime!
}
