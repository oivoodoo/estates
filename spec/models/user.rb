require 'spec_helper'

describe User do
  describe '#role?' do
    let(:user) { create(:user) }

    it 'user role should be quals admin' do
      expect(user.role?(:admin)).to be_true
    end
  end
end

