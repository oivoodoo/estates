class BlogController < ApplicationController
  def index
    @posts = PostsDecorator.decorate(Post.paginate(page: params[:page]))
  end
end
